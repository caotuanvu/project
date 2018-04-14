<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 16-Jan-18
 * Time: 4:11 AM
 */

class Template
{
    private $controller;
    // FILE TEMPLATE(group.php)
    private $fileTemplate;
    // FILE TEMPLATE(template.ini)
    private $configTemplate;

    // FILE TEMPLATE(admin/main/)
    private $folderTemplate;

    public function __construct($value)
    {
        $this->controller = $value;
    }
   // LOAD INTERFACE
    public function load()
    {
        // Run Obj View;
        $view = $this->controller->getView();
        // FILE CÒN
        $fileConfig = PUBLIC_PATH . TEMPLATE_PATH . $this->folderTemplate . DS . $this->configTemplate;
        if (file_exists($fileConfig) == true) {
            $arrConfig  = parse_ini_file($fileConfig);

            $view->_title    = $this->createTitle($arrConfig['title']);
            $view->_metaHttp = $this->createMeta($arrConfig['metaHTTP'],'http-equiv');
            $view->_metaName = $this->createMeta($arrConfig['metaName'],'name');
            $view->_fileJs   = $this->createFile($arrConfig['rootJs'], $arrConfig['fileJs'],'js');
            $view->_fileCss  = $this->createFile($arrConfig['rootCss'], $arrConfig['fileCss'],'css');
            $view->_image    = 'public'. DS. TEMPLATE_PATH. $this->folderTemplate. DS.  $arrConfig['dirImg']. DS;


          $path = PUBLIC_PATH . TEMPLATE_PATH . $this->folderTemplate . DS . $this->fileTemplate;
            $view->templatePath = $path;
        }
    }

  // CREATE FILE ( JS + CSS)
    private function createFile($root, $file, $type = 'css')
    {
        $xhtml = '';
        if (!empty($file)) {
            $path = TEMPLATE_URL.$this->folderTemplate .DS . $root . DS;
            foreach ($file as $value) {
                if($type== 'css') {
                    $xhtml .= '<link rel="stylesheet" href="' . $path . $value . '" />';
                }elseif($type== 'js'){
                    $xhtml .= '<script type="text/javascript" src="'.$path. $value . '"></script>';
                }
            }
        }
        return $xhtml;
    }
   // CREATE FILE ( META NAME + META HTTP)
    private function createMeta($meta,$type = 'name')
    {
        $xhtml = '';
        if (!empty($meta)) {
            foreach ($meta as $value) {
                $value = explode("|", $value);
                $xhtml .= '<meta '.$type.'="' . $value[0] . '" content="' . $value[1] . '">';
            }
        }
        return $xhtml;
    }

 // CREATE TITLE ( )
    private function createTitle($value)
    {
        return '<title>' . $value . '</title>';
    }
   // SET FILE TEMPLATE(group.php)
    public function setFileTemplate($value = 'group.php')
    {
        $this->fileTemplate = $value;
    }
    // SET FILE TEMPLATE(admin/main)
    public function setFolderTemplate($value = 'admin/main')
    {
        $this->folderTemplate = $value;
    }
    // SET FILE TEMPLATE(template.ini)
    public function setConfigTemplate($value = 'template.ini')
    {
        $this->configTemplate = $value;
    }


    public function getFileTemplate()
    {
        return $this->fileTemplate;
    }

    public function getFolderTemplate()
    {
        return $this->folderTemplate;
    }

    public function getConfigTemplate()
    {
        return $this->configTemplate;
    }
}