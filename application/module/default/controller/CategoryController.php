<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 22-Mar-18
 * Time: 9:27 PM
 */

class CategoryController extends Controller
{
    public function __construct($arrParam)
    {
        parent::__construct($arrParam);
        $this->templateObj->setFileTemplate('index.php');
        $this->templateObj->setConfigTemplate('template.ini');
        $this->templateObj->setFolderTemplate('default/main');
        $this->templateObj->load();
    }
    public function indexAction()
    {
        require_once SCRIPT.DS.'categoryXMl.php';
        $this->view->title = 'Category';
        $this->view->listItems  = categoryXML::getCategoryXML('category.xml');
        $this->view->render('category/index');

    }
}