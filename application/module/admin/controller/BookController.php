<?php
/**
 * Created by PhpStorm.
 * book: PC
 * Date: 14-Jan-18
 * Time: 3:56 PM
 */

class BookController extends Controller
{
    private $_arrDB = array('id','name','special','picture','vl_picture','description','created','modified','price','sale_off','category_id','ordering','status');
    public function __construct($arrParam)
    {
        parent::__construct($arrParam);
        $this->templateObj->setFileTemplate('index.php');
        $this->templateObj->setConfigTemplate('template.ini');
        $this->templateObj->setFolderTemplate('admin/main');
        $this->templateObj->load();

    }

    public function indexAction(){
        $this->view->title = 'Book-manager';

        // truyen du lieu ra view
       $totalItems               = $this->_models->countItem($this->_arrParam,null);

        // SET PANIGATION
        $config   = array('totalItemPerPage' => 4, 'pageRange' => 2 );
        $this->setPanigation($config);

        $this->view->panigation        = new panigation($totalItems,$this->panigation);
        $this->view->listItems         = $this->_models->listItem($this->_arrParam);

        $this->view->category_name = $this->_models->showGroupName();
        $this->view->render('book/index');

    }

    public function formAction(){
        $this->view->category_name = $this->_models->showGroupName();

        $queryExist  = "SELECT `id` FROM `".DS_BOOK."` WHERE `name` = '".isset($this->_arrParam['form']['name'])."'";
        $task        = 'add';
        $require     = true;
        if(isset($this->_arrParam['id']) == true){

            $this->view->arrParam['form']['id'] = $this->_arrParam['id'];
            $queryExist .= " AND `id` <> '".$this->_arrParam['id']."'";
            $this->view->arrParam['form']        = $this->_models->editItem($this->_arrParam['id']);
            $task = 'edit';

            if(empty($this->view->arrParam['form'])) redirect::locationHeader('admin','book','index');

        }

        if(isset($this->_arrParam['form']['id']) == true) {$require = false; $task = 'edit';}

        if(isset($this->_arrParam['taken']) > 0){


            // ADD 2 PHẦN TỬ
            $this->_arrParam['form']['created']    = date('Y-m-d', time());
            $this->_arrParam['form']['modified']   = date('Y-m-d', time());
            $this->_arrParam['form']['picture']    = $_FILES['picture'];
            $this->_arrParam['form']['id']         = $this->_arrParam['id'];

            $source   = array_intersect_key($this->_arrParam['form'], array_flip($this->_arrDB));

            $validate = new validate($source);


            $validate->addrule('name','recordexist', array('database' => $this->_models,'query' => $queryExist, 'min' => 5, 'max' => 255),$require)
                     ->addrule('picture', 'file', array('min' => 5000, 'max' => 5000000, 'extension' => array('png','jpeg','jpg')),$require)
                     ->addrule('status','status', array('deny'=> array(2)),$require)
                     ->addrule('category_id','status', array('deny'=> array(0)),$require)
                     ->addrule('description','string', array('min' => 10, 'max' => 1555),$require)
                     ->addrule('price','number',null,$require)
                     ->addrule('sale_off','number',null,$require)
                     ->addrule('special','number',null,$require)
                     ->addrule('ordering','ordering', array('max'=> array(10)),$require);
            $validate->checkValidate();

            if($validate->isVali() == false){
                $this->view->error = $validate->showErrors();
            }else{
                $this->_models->saveItem($source,array('task' => "$task"));

                if($this->_arrParam['type'] == 'save_close') redirect::locationHeader('admin','book','index');

                if($this->_arrParam['type'] == 'save_new') redirect::locationHeader('admin','book','form');

            }
            $this->view->arrParam['form']['id'] = $this->_arrParam['form']['id'];
            $this->view->arrParam['form']       = $validate->getResult();

        }
//        if(isset($this->_arrParam['type']) == 'close') redirect::locationHeader('admin','book','index');
        $this->view->title = 'Book add';
        $this->view->render('book/add');
    }
    // ajax status
    public function editStatusAction(){
      $result =   $this->_models->changeStatusIcons($this->_arrParam,array('task' => 'change-ajax-status'));
      echo json_encode($result);

    }


    // AJAX STATUS UNPUBLIC - PUBLIC
    public function statusAction(){
      $this->_models->changeStatusIcons($this->_arrParam,array('task' => 'change-submit-status'));
          redirect::locationHeader('admin','book','index');
    }
    // AJAX STATUS TRASH
    public function TrashAction(){
        $this->_models->TrashElement($this->_arrParam);
        redirect::locationHeader('admin','book','index');
    }

    public function orderingAction(){

        $this->_models->CheckOrdering($this->_arrParam);
        redirect::locationHeader('admin','book','index');
    }
}