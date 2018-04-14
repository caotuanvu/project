<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 14-Jan-18
 * Time: 5:08 PM
 */

class UserModels extends models
{
  protected $_bgName = DS_TABLE_USER;
  public function __construct()
  {
       parent::__construct();
      $this->setTable($this->_bgName);
  }

    public function ListItem($arrayParam, $option)
    {

        if($option['task'] == 'add-my-cart'){

            $cart = Session::get('cart');
            $result = array();

            if(!empty($cart)){

                $cId = '';
                foreach ($cart['quantities'] as $key => $value) $cId .= "'$key',";
                $cId .= "'0'";

                $query[] = "SELECT `id`, `name`, `picture` FROM `".DS_BOOK."` WHERE `status` = '1'";
                $query[] = "AND `id` IN (".$cId.") ORDER BY `ordering` ASC";
                $query   = implode('',$query);
                $result   = $this->showSelect($query);

                foreach ($result as $key => $value){
                    $result[$key]['quantities'] = $cart['quantities'][$value['id']];
                    $result[$key]['prices']      = $cart['price'][$value['id']];
                    $result[$key]['price_item']  = $result[$key]['prices']/$result[$key]['quantities'];
                }
              return $result;
            }
        }
        if($option['task'] == 'show-my-cart'){

            $name  = $_SESSION['userInfo']['info']['username'];
            $query = "SELECT * FROM `".DS_CART."` WHERE `username` = '".$name."'";
            return $this->showSelect($query);
        }
    }

     //SAVE INFO  ĐƠN HÀNG
    public function saveItem($arrayParam, $option)
    {
        if($option['task'] == 'save-items'){

            $session = Session::get('userInfo');

            $username = $session['info']['username'];
            $date     = date('Y-m-d H:i:s',time());
            $id       =  $this->random('6');

            $book_id        = json_encode($arrayParam['form']['book_id']);
            $names_book     = json_encode($arrayParam['form']['name_book']);
            echo "<pre>";
            print_r($names_book);
            echo "</pre>";
            die();
            $pictures       = json_encode($arrayParam['form']['picture']);
            $prices         = json_encode($arrayParam['form']['price']);
            $quantities     = json_encode($arrayParam['form']['quantities']);


            $status         = 0;
            $query[]  = "INSERT INTO `".DS_CART."` (`id`,`username`,`books`,`prices`,`quantities`,`status`,`names`,`picture`,`date`)";
            $query[]  = "VALUES ('$id','$username','$book_id','$prices','$quantities','$status','$names_book','$pictures','$date')";
            $query    = implode(' ', $query);
            $this->query($query);
        }
    }
    private function random($length = 5){
        $arrCharacter = array_merge(range("A", "Z"),range("a", "z"),range(0,9));
        $arrCharacter = implode($arrCharacter, '');
        $arrCharacter = str_shuffle($arrCharacter);
        $result       = substr($arrCharacter,0 ,$length);
        return $result;
    }
}