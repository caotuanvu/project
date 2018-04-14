<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 14-Jan-18
 * Time: 3:50 PM
 */

class Boostrap

{
    public $_controllerObj;
    public $_url;

    public function init()
    {

        $this->getURL();
        $controllerName = ucfirst($this->_url['controller']) . 'Controller';
        $file = MODULE_ROOT . $this->_url['module'] . DS . 'controller' . DS . $controllerName . '.php';

        if(file_exists($file)) {
            $this->loadFileExistController($file, $controllerName);
            $this->callToMethodsController();
        }else{
            $this->__Error();
        }
        }


    // CALL TO METHODS OF CONTROLLLER
    public function callToMethodsController()
    {
        $ActionName = $this->_url['action'] . 'Action';
        if (method_exists($this->_controllerObj, $ActionName)) {

            $module      =$this->_url['module'];
            $controller  =$this->_url['controller'];
            $action      =$this->_url['action'];

             $checkAdminTrator = $module . '-'. $controller. '-'. $action;
            // CHECK LOGIN
            //$arrayParam['form']['picture']
            $logged     =  isset($_SESSION['userInfo']) ? $_SESSION['userInfo']['login'] = 1: '';
            $group_acp  =  isset($_SESSION['userInfo']) ? $_SESSION['userInfo']['group_acp'] : '';


            if($module == 'admin'){
                if($logged == ""){
                    if($controller == 'index' && $action == 'login') {
                        $this->_controllerObj->$ActionName();
                    }else{
                        Session::delete('userInfo');
                        redirect::locationHeader('admin','index','login');
                    }
                }elseif ($logged == true){
                    if($group_acp == 1){
//                        if(in_array($checkAdminTrator,$_SESSION['userInfo']['info']['private']) == true){
                            $this->_controllerObj->$ActionName();
//                        }else{
//                            redirect::locationHeader('default','index','notice', array('type' => 'not-permission'));
//                        }
                    }else{
                        redirect::locationHeader('default','index','notice', array('type' => 'not-permission'));
                    }
                }
            }elseif ($module == 'default'){
                if($controller == "user"){
                  if($logged == true){
                      $this->_controllerObj->$ActionName();
                  }else{
                      $this->callLoginAction();
                  }
                }else{
                    $this->_controllerObj->$ActionName();
                }
            }else{
                Session::delete('userInfo');
                redirect::locationHeader('default','index','notice', array('type' => 'not-login'));
            }
//            $this->_controllerObj->$ActionName();
            $this->_controllerObj->loadModel($this->_url['module'], $this->_url['controller']);
        }else {
            $this->__Error();
        }
    }

        // CALL ACTION LOGIN
    private function callLoginAction($module = 'default')
    {
        Session::delete('user');
        $path = MODULE_ROOT . $module . DS . 'controller' . DS . 'IndexController.php';
       if(file_exists($path)){
           require_once $path;
           $indexController = new IndexController($this->_url);
           $indexController->loginAction();
       }

    }



    // L0AD FILE EXIST CONTROLLER;
    public function loadFileExistController($file,$controllerName)
    {
            require_once $file;
            $this->_controllerObj = new $controllerName($this->_url);

    }

    // LOAD FILE CONTROLLER
    public function getURL()
    {
        $this->_url 	            = array_merge($_GET, $_POST);
        $this->_url['module'] 		= isset($this->_url['module']) ? $this->_url['module'] : APPLICATION_PATH;
        $this->_url['controller'] 	= isset($this->_url['controller']) ? $this->_url['controller'] : CONTROLLER_PATH;
        $this->_url['action'] 		= isset($this->_url['action']) ? $this->_url['action'] : ACTION_PATH;
    }


    public function __Error()
    {
        $fileError = MODULE_ROOT . 'default' . DS . 'controller' . DS . 'ErrorController.php';
        if(file_exists($fileError)){
            require_once $fileError;
            $errors = new ErrorController($this->_url);
            $errors->setView('default');
            $errors->indexAction();
        }

    }
}