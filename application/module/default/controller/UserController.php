<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 14-Jan-18
 * Time: 3:56 PM
 */

class UserController extends Controller
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
    // MY- ACCOUNT
      public function indexAction(){
          $this->view->title = 'Myaccount';
         $this->view->render('user/index');
    }

    // MY- ACCOUNT
    public function cartAction(){
        $this->view->Items  = $this->_models->ListItem($this->_arrParam,array('task' => 'add-my-cart'));
        $this->view->title = 'Cart';
        $this->view->render('user/cart');
    }


    // MY- ACCOUNT
    public function historyAction(){
        $this->view->Items  = $this->_models->ListItem($this->_arrParam,array('task' => 'show-my-cart'));
        $this->view->title = 'History';
        $this->view->render('user/history');
    }
    

    // CREATE SESSSION
     public function orderAction(){

         $cart      = Session::get('cart');
         $bookId    = $this->_arrParam['book_id'];
         $price     = $this->_arrParam['price'];


         if(empty($cart)){
            $cart['quantities'][$bookId] = 1;
            $cart['price'][$bookId]      = $price;
         }else{
             if(array_key_exists($bookId,$cart['quantities'])){
                 $cart['quantities'][$bookId] += 1;
                 $cart['price'][$bookId]      = $price *  $cart['quantities'][$bookId];
             }else{
                 $cart['quantities'][$bookId] = 1;
                 $cart['price'][$bookId]      = $price;
             }
         }

         Session::set('cart',$cart);
         redirect::locationHeader('default','book','detail',array('book_id' => $this->_arrParam['book_id']));
     }
     // SALE
     public function buyAction(){
        $this->_models->saveItem($this->_arrParam,array('task' => 'save-items'));
        redirect::locationHeader('default','book','index',null,'book.html');

     }


    
    

}