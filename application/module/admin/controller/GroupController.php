<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 14-Jan-18
 * Time: 3:56 PM
 */

class GroupController extends Controller
{
    private $_arrDB = array('id', 'name', 'group_acp', 'created', 'ordering', 'created_by', 'modified', 'modified_by', 'status');

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
        $this->view->title = 'Group-manager';

        // truyen du lieu ra view
       echo $totalItems = $this->_models->countItem($this->_arrParam, null);

        // SET PANIGATION
        $config = array('totalItemPerPage' => 2, 'pageRange' => 2);
        $this->setPanigation($config);

        $this->view->panigation = new panigation($totalItems, $this->panigation);
        $this->view->listItems  = $this->_models->listItem($this->_arrParam);
        $this->view->render('group/index');
    }



    // ajax status
    public function editStatusAction()
    {
       $result = $this->_models->changeStatusIcons($this->_arrParam, array('task' => 'change-ajax-status'));
      echo json_encode($result);

    }

    // AJAX GROUP_ACP
    public function editGroupACPAction()
    {
        $result = $this->_models->changeStatusIcons($this->_arrParam, array('task' => 'change-ajax-group_acp'));
        echo json_encode($result);
    }

    // AJAX STATUS UNPUBLIC - PUBLIC
    public function statusAction()
    {
        $this->_models->changeStatusIcons($this->_arrParam, array('task' => 'change-submit-status'));
        redirect::locationHeader('admin','group','index');
    }
//
//    // AJAX STATUS TRASH
//    public function TrashAction()
//    {
//        $this->_models->TrashElement($this->_arrParam);
//        redirect::locationHeader('admin','group','index');
//    }

    public function orderingAction()
    {
        $this->_models->CheckOrdering($this->_arrParam);
        redirect::locationHeader(URL::setURL('admin', 'group', 'index'));
    }
}