<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 14-Jan-18
 * Time: 7:39 PM
 */

class View
{
    public $_module;
    // (admin/main\group.php)
    public $templatePath;
    public $_title;
    public $_metaHttp;
    public $_metaName;
    public $_fileCss;
    public $_fileJs;
    public $_fileContent;
    public $error;
    public function __construct($module)
    {
         $this->_module = $module;

    }


    // load file
    public function render($fileInclude, $fullFile = true){
     $path = MODULE_ROOT. $this->_module. DS .'views'. DS. $fileInclude.'.php';
        if(file_exists($path)){
            if($fullFile == true){
                $this->_fileContent = $fileInclude;
                require_once $this->templatePath;
            }else{
                require_once $path;
            }
        }else{
            echo "File not Record";
        }
    }

    public function setTitle($value){
       $this->_title = '<title>' . $value . '</title>';
    }
    // appen Css to modules
    public function appenCss($arrCss){
       if(!empty($arrCss)){
           foreach ($arrCss as $value) {
               echo $path = '..'.PATH_CSS. $value;
               if(file_exists($path)){
                   $this->_fileCss .= '<link rel="stylesheet" href="' . $path .'" />';
               }
           }
       }
    }
   // appen js to modules
    public function appenJs($arrJs){
        if(!empty($arrJs)){
            foreach ($arrJs as $value) {
                echo $path = '..'.PATH_CSS. $value;
                if(file_exists($path)){
                    $this->_fileJs .= '<script type="text/javascript" src="'.$path. '" />';
                }
            }
        }
    }


}