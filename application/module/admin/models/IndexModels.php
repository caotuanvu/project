<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 19-Mar-18
 * Time: 3:10 PM
 */

class IndexModels extends models
{
 public function __construct()
  {
      parent::__construct();
  }
  public function getItemInfo($arrParam,$option=null){

     if($option == null){
         $result    = array();
         $username = $arrParam['form']['username'];
         $pass     = md5($arrParam['form']['pwd']);
         $query[]  = "SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`group_id`, `g`.`group_acp`, `g`.`private_id`";
         $query[]  = "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
         $query[]  = "WHERE `u`.`username` = '$username' AND `u`.`password` = '$pass'";
         $query    = implode(" ", $query);

         $result     = $this->singleRecord($query);

         $session  = Session::get('userInfo');

            if($result['group_acp'] == 1){
                $idPrivate = explode(",",$result['private_id']);
                $xhtml = '';
                foreach ($idPrivate as $value) {
                  $xhtml .= "'$value' ,";
                }
                 $queryPr[] = "SELECT `id`, CONCAT(`module`, '-', `controller`, '-', `action`) AS 'name'";
                 $queryPr[] = "FROM `".PRIVATE_NAME."` WHERE id IN($xhtml'0')";
                 $queryPr   = implode(' ',$queryPr);
                 $result['private']  = $this->fetchQuery($queryPr);
            }
          return $result;
     }

  }
}