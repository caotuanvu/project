<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 14-Jan-18
 * Time: 3:57 PM
 */

class Controller
{

    //VIEW OBJECT
    protected $view;
    // Model Obj
    protected $_models;
    // Param
    protected $_arrParam;
    // template object
    public $templateObj;

    protected $panigation = array('totalItemPerPage' => 2, 'pageRange' => 3);
    public function __construct($arrParams)
    {

        $this->loadModel($arrParams['module'],$arrParams['controller']);
        $this->setView($arrParams['module']);
        $this->setTemplate($this);

        $this->panigation['currentPage']  = (isset($arrParams['filter_page'])) ? $arrParams['filter_page'] : 1;

        // truyền tham só panigation ra view
        $arrParams['panigation'] = $this->panigation;
        $this->setParam($arrParams);
        $this->view->action  = $arrParams['action'];
        $this->view->arrParam = $arrParams;
    }
    // LOAD MODEL
    public function loadModel($module,$modelsName)
    {
        $modelsName = ucfirst($modelsName) . 'Models';
        $path = MODULE_ROOT. $module .DS. 'models' .DS . $modelsName . '.php';
        if (file_exists($path)) {
            require_once $path;
            $this->_models = new $modelsName();
        }
    }


    // SET PANIGATION

    public function setPanigation($config){
        $this->panigation['totalItemPerPage'] = $config['totalItemPerPage'];
        $this->panigation['pageRange']        = $config['pageRange'];
        $this->_arrParam['panigation']        = $this->panigation;
        $this->view->arrParam['panigation']   = $this->_arrParam['panigation'];
    }


    // LOAD MODEL
    public function getModels(){
        return $this->_models;
    }

    public function setView($module){
        $this->view = new View($module);
    }

    public function getView(){
       return $this->view;
    }
    public function setParam($param){
        $this->_arrParam = $param;
    }

    public function getParam(){
        return $this->_arrParam;
    }

    public function setTemplate($value){
        $this->templateObj = new Template($value);
    }

    public function getTemplate(){
        return $this->templateObj;
    }
}