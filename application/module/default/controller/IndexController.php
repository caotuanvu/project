<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 14-Jan-18
 * Time: 3:56 PM
 */

class IndexController extends Controller
{
    private $_arrDB = array('id ','email','password','username','group_id','created','ordering','created_by','modified','modified_by','status');
	public function __construct($arrParam)
	{
		parent::__construct($arrParam);
        $this->templateObj->setFileTemplate('index.php');
        $this->templateObj->setConfigTemplate('template.ini');
        $this->templateObj->setFolderTemplate('default/main');
        $this->templateObj->load();
	}
    public function noticeAction(){
          $this->view->title = 'Notice';
         $this->view->render('index/notice');
    }

    public function indexAction(){
          $this->view->title = 'Index';
         $this->view->listItems  = $this->_models->listItem($option =null);
         $this->view->render('index/index');
    }
    // REGISTER
    public function registerAction(){
        $this->view->title = 'Register';

           if(isset($this->_arrParam['form']['submit']) == 'register'){

            // NOT REFESH
            if(Session::get('token') == $this->_arrParam['form']['token']){
                Session::delete('token');
                redirect::locationHeader('default','index', 'register');
            }else{
                Session::set('token',$this->_arrParam['form']['token']);
            }

            //VALIDATE
            $source      = array_intersect_key($this->_arrParam['form'], array_flip($this->_arrDB));

            $queryExist  = "SELECT `id` FROM `".DS_TABLE_USER."` WHERE `username` = '". $source['username']. "'";
            $queryEmail  = "SELECT `id` FROM `".DS_TABLE_USER."` WHERE `email` = '". $source['email']. "'";

            $validate = new validate($source);
            $validate->addrule('username','exist-string', array('database' => $this->_models,'query' => $queryExist, 'min' => 5, 'max' => 255))
                ->addrule('password','password',array('action' => 'add'))
                ->addrule('email','email-exist',array('database' => $this->_models,'query' => $queryEmail));
            $validate->checkValidate();

            $source['fullname'] = $this->_arrParam['form']['fullname'];
            if($validate->isVali() == false){
                $this->view->error = $validate->showErrors();
            }else{
                $this->_models->saveItem($source,array('task' => 'register-save'));
//                redirect::locationHeader('default','index','notice',array('type' => 'sucess'));

            }
            $this->view->arrParam['form'] 		        = $validate->getResult();
            $this->view->arrParam['form']['fullname']   = $this->_arrParam['form']['fullname'];

        }
        $this->view->render('index/register');
    }

    public function loginAction(){
	    if(isset($this->_arrParam['form'])) {
            if ($this->_arrParam['form']['token'] > 0) {
                $email = $this->_arrParam['form']['email'];
                $password = md5($this->_arrParam['form']['pwd']);
                $query    = "SELECT `id` FROM `user` WHERE `email` ='$email' AND `password` = '$password'";
                $validate = new validate($this->_arrParam['form']);
                $validate->addrule('email', 'user-exist', array('database' => $this->_models, 'query' => $query));
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
                    redirect::locationHeader('default', 'category', 'index');
                }else {
                    $this->view->error = $validate->showerrorElement();
                }
            }
        }
        $this->view->title = 'login-admin';
        $this->view->render('index/login');
    }

    public function logoutAction(){
        Session::delete('userInfo');
        redirect::locationHeader('default','index','login');
    }


}