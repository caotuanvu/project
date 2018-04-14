<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 14-Jan-18
 * Time: 3:56 PM
 */

class ErrorController extends Controller
{

    public function indexAction(){
		$this->templateObj->setFileTemplate('index.php');
        $this->templateObj->setConfigTemplate('template.ini');
        $this->templateObj->setFolderTemplate('default/main');
        $this->templateObj->load();

        $this->view->title = "Error";
        $this->view->render('error/index');
    }
}