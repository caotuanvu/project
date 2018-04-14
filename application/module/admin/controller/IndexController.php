<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 19-Mar-18
 * Time: 8:46 AM
 */

class IndexController extends Controller
{
    public function __construct($arrParam)
    {
        parent::__construct($arrParam);
        $this->templateObj->setFileTemplate('index.php');
        $this->templateObj->setConfigTemplate('template.ini');
        $this->templateObj->setFolderTemplate('admin/main');
        $this->templateObj->load();

    }

    public function indexAction(){
        $this->view->title = 'Index-admin';
        $this->view->render('index/index');
    }

    public function loginAction(){
        if(isset($this->_arrParam['form'])) {
            if ($this->_arrParam['form']['token'] > 0) {
                $username = $this->_arrParam['form']['username'];
                $password = md5($this->_arrParam['form']['pwd']);
                $query = "SELECT `id` FROM `user` WHERE `username` ='$username' AND `password` = '$password'";
                $validate = new validate($this->_arrParam['form']);
                $validate->addrule('username', 'user-exist', array('database' => $this->_models, 'query' => $query));
                $validate->checkValidate();
                if ($validate->isVali() == true) {
                    $getInfo = $this->_models->getItemInfo($this->_arrParam);
                    $arrSession = array(
                        'login' => true,
                        'info' => $getInfo,
                        'time' => time(),
                        'group_acp' => $getInfo['group_acp']
                    );
                    Session::set('userInfo', $arrSession);
                    redirect::locationHeader('admin', 'index', 'index');
                } else {
                    $this->view->error = $validate->showerrorElement();
                }
            }
        }

        $this->view->title = 'login-admin';
        $this->view->render('index/login');
    }

    public function logoutAction(){
        Session::delete('userInfo');
        redirect::locationHeader('admin','index','login');
    }
}