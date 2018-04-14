<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 22-Mar-18
 * Time: 9:27 PM
 */

class BookController extends Controller
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
        $this->view->title = 'Book';

        $this->view->listItems  = $this->_models->listItem($this->_arrParam,$option =null);
        $this->view->render('book/index');

    }

    public function detailAction()
    {

        $this->view->title = 'Detail';
        $this->view->listItems  = $this->_models->showItem($this->_arrParam,$option =null);
        $this->view->render('book/detail');

    }


    public function showBookAction()
    {
        $this->view->title = 'showBook';
        $this->view->listItems  = $this->_models->showBook($this->_arrParam,$option ='book-relate');
        $this->view->render('book/relateBook',false);

    }
}