<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 21-Mar-18
 * Time: 8:31 PM
 */

class IndexModels extends models
{
    protected $_bgName = DS_TABLE_USER;
    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->_bgName);
    }

    public function saveItem($arrParam,$option)
    {
        if($arrParam['password'] != null){
            $arrParam['password'] = md5($arrParam['password']);
        }else{
            unset($arrParam['password']);
        }

        $arrParam['register-date']   =  date("Y-m-d h:i:sa", time());
        $arrParam['register-ip']     =  $_SERVER['REMOTE_ADDR'];

        if($option['task'] == 'register-save'){
            $this->setInsert($arrParam);
        }
    }
    public function getItemInfo($arrParam,$option=null){
        if($option == null){
            $email    = $arrParam['form']['email'];
            $pass     = md5($arrParam['form']['pwd']);
            $query[]  = "SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`group_id`, `g`.`group_acp`";
            $query[]  = "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
            $query[]  = "WHERE `u`.`email` = '$email' AND `u`.`password` = '$pass'";
            $query    = implode(" ", $query);
            return  $result = $this->singleRecord($query);
        }
    }

    public function listItem($option)
    {
        if($option == null){
            $result = '';
            $query[] = "SELECT `id`, `name`, `picture`, `price`, `sale_off`, `category_id`";
            $query[] = "FROM `book`";
            $query[] = "WHERE `status` = '1'";
            $query[] = "ORDER BY `created` DESC";
            $query[] = "LIMIT 0,8";
           $query   = implode(' ', $query);
            return $result = $this->showSelect($query);

        }

    }

}