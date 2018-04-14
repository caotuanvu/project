<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 14-Jan-18
 * Time: 3:56 PM
 */

class CategoryController extends Controller
{
    private $_arrDB = array('id', 'name', 'picture', 'created', 'ordering', 'created_by', 'modified', 'modified_by', 'status');

    public function __construct($arrParam)
    {
        parent::__construct($arrParam);
        $this->templateObj->setFileTemplate('index.php');
        $this->templateObj->setConfigTemplate('template.ini');
        $this->templateObj->setFolderTemplate('admin/main');
        $this->templateObj->load();

    }

    public function indexAction()
    {
        $this->view->title = 'category-manager';

//
        // truyen du lieu ra view
        $totalItems = $this->_models->countItem($this->_arrParam, null);

        // SET PANIGATION
        $config = array('totalItemPerPage' => 4, 'pageRange' => 2);
        $this->setPanigation($config);
        $this->view->panigation = new panigation($totalItems, $this->panigation);

        $this->view->listItems    = $this->_models->listItem($this->_arrParam);
        $this->view->render('category/index');
    }

    public function formAction()
    {
//        // EDIT

        if ($this->_arrParam['id'] != '') {
            $this->view->arrParam['form'] = $this->_models->showItem($this->_arrParam['id']);
            if (empty($this->view->arrParam['form'])) redirect::locationHeader('admin', 'category', 'index');

            $this->_arrParam['form']['id'] = $this->view->arrParam['form']['id'];
        }

//        if (isset($this->_arrParam['type']) == 'close') redirect::locationHeader('admin', 'category', 'index');


        if (isset($this->_arrParam['form']['taken']) > 0) {
            $id    = $this->_arrParam['form']['id'];
            $queryExist  = "SELECT `id` FROM `category` WHERE `name` = '". $this->_arrParam['form']['name']. "'";
            if($id != ''){
                $queryExist  .= "AND `id` <> '$id'";
            }

                $this->_arrParam['form']['picture']  = $_FILES['picture'];
                // ADD 2 PHẦN TỬ
                $this->_arrParam['form']['created']  = date('Y-m-d', time());
                $this->_arrParam['form']['modified'] = date('Y-m-d', time());

                $source = array_intersect_key($this->_arrParam['form'], array_flip($this->_arrDB));
                $validate = new validate($source);
                $validate->addrule('name', 'exist-string', array('min' => 5, 'max' => 255,'database' => $this->_models, 'query' => $queryExist))
                         ->addrule('status', 'status', array('deny' => array(2)))
                         ->addrule('picture', 'file', array('min' => 111000, 'max' => 5000000, 'extension' => array('png','jpg')),false)
                         ->addrule('ordering', 'ordering', array('max' => array(10)));
                $validate->checkValidate();


                if ($validate->isVali() == false) {
                    $this->view->error = $validate->showErrors();
                } else {
                    $task = (!empty($this->_arrParam['form']['id'])) ? 'edit' : 'add';
                    $source['vl_picture'] = $this->_arrParam['form']['vl_picture'];
                    $this->_models->saveItem($source, array('task' => "$task"));


//                    if ($this->_arrParam['type'] == 'save_close') redirect::locationHeader('admin', 'category', 'index');
//                    if ($this->_arrParam['type'] == 'save_new') redirect::locationHeader('admin', 'category', 'form');
                }
                $this->view->arrParam['form'] = $validate->getResult();

            }
        $this->view->title = 'category-Save';
        $this->view->render('category/add');
    }

    // ajax status
    public function editStatusAction()
    {
       $result = $this->_models->changeStatusIcons($this->_arrParam, array('task' => 'change-ajax-status'));
      echo json_encode($result);

    }


    // AJAX STATUS UNPUBLIC - PUBLIC
    public function statusAction()
    {
        $this->_models->changeStatusIcons($this->_arrParam, array('task' => 'change-submit-status'));
        redirect::locationHeader('admin','category','index');
    }

    // AJAX STATUS TRASH
    public function TrashAction()
    {
        $this->_models->TrashElement($this->_arrParam);
//        redirect::locationHeader('admin','category','index');
    }

    public function orderingAction()
    {
        $this->_models->CheckOrdering($this->_arrParam);
        redirect::locationHeader('admin', 'category', 'index');
    }
}