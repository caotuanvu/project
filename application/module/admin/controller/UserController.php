<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 14-Jan-18
 * Time: 3:56 PM
 */

class UserController extends Controller
{
    private $_arrDB = array('id ','fullname','email','password','username','group_id','created','ordering','created_by','modified','modified_by','status');
    public function __construct($arrParam)
    {
        parent::__construct($arrParam);
        $this->templateObj->setFileTemplate('index.php');
        $this->templateObj->setConfigTemplate('template.ini');
        $this->templateObj->setFolderTemplate('admin/main');
        $this->templateObj->load();

    }

    public function indexAction(){
        $this->view->title = 'user-manager';

        // truyen du lieu ra view
       $totalItems               = $this->_models->countItem($this->_arrParam,null);

        // SET PANIGATION
        $config   = array('totalItemPerPage' => 4, 'pageRange' => 2 );
        $this->setPanigation($config);

        $this->view->panigation        = new panigation($totalItems,$this->panigation);
        $this->view->listItems = $this->_models->listItem($this->_arrParam);

        $this->view->group_name = $this->_models->showGroupName();


        $this->view->render('user/index');

    }

    public function formAction(){
        $this->view->group_name = $this->_models->showGroupName();
        // EDIT
        $task    = 'add';
        $require = true;


        $queryExist  = "SELECT `id` FROM `".DS_TABLE_USER."` WHERE `username` = '". $source['username']. "'";
        $queryEmail  = "SELECT `id` FROM `".DS_TABLE_USER."` WHERE `email` = '". $source['email']. "'";

        if(isset($this->_arrParam['id']) == true){
            $queryExist .= " AND `id` <> '".$this->_arrParam['id']."'";
            $queryEmail .= " AND `id` <> '".$this->_arrParam['id']."'";
            $this->view->arrParam['form']        = $this->_models->editItem($this->_arrParam['id']);
            if(empty($this->view->arrParam['form'])) redirect::locationHeader('admin','user','index');

        }

       if(!empty($this->_arrParam['form']['id'])){
            $require = false;
            $task = 'edit';
           $this->_arrParam['form']['id'] = $this->view->arrParam['form']['id'];
        }


        if($this->_arrParam['type'] == 'close') redirect::locationHeader('admin','user','index');


        if($this->_arrParam['form']['taken'] > 0){
            // ADD 2 PHẦN TỬ
            $this->_arrParam['form']['created']    = date('Y-m-d', time());
            $this->_arrParam['form']['modified']   = date('Y-m-d', time());

            $source   = array_intersect_key($this->_arrParam['form'], array_flip($this->_arrDB));
            $validate = new validate($source);
            $validate->addrule('username','recordexist', array('database' => $this->_models,'query' => $queryExist, 'min' => 5, 'max' => 255))
                     ->addrule('fullname','string',array('min' => 5, 'max' => 255))
                     ->addrule('password','password',array('action' => $task),$require)
                     ->addrule('email','email-exist',array('database' => $this->_models,'query' => $queryEmail))
                     ->addrule('status','status', array('deny'=> array(2)))
                     ->addrule('ordering','ordering', array('max'=> array(10)))
                     ->addrule('group_id','status', array('deny'=> array(0)));
            $validate->checkValidate();

            if($validate->isVali() == false){
                $this->view->error = $validate->showErrors();
            }else{
                $this->_models->saveItem($source,array('task' => "$task"));

                if($this->_arrParam['type'] == 'save_close') redirect::locationHeader('admin','user','index');

                if($this->_arrParam['type'] == 'save_new') redirect::locationHeader('admin','user','form');
            }
            $this->view->arrParam['form']  = $validate->getResult();

        }
        $this->view->title = 'user-Save';
        $this->view->render('user/add');
    }
    // ajax status
    public function editStatusAction(){
      $result =   $this->_models->changeStatusIcons($this->_arrParam,array('task' => 'change-ajax-status'));
      echo json_encode($result);

    }


    // AJAX STATUS UNPUBLIC - PUBLIC
    public function statusAction(){
      $this->_models->changeStatusIcons($this->_arrParam,array('task' => 'change-submit-status'));
          redirect::locationHeader('admin','user','index');
    }
    // AJAX STATUS TRASH
    public function TrashAction(){
        $this->_models->TrashElement($this->_arrParam);
        redirect::locationHeader('admin','user','index');
    }

    public function orderingAction(){

        $this->_models->CheckOrdering($this->_arrParam);
        redirect::locationHeader('admin','user','index');
    }
}