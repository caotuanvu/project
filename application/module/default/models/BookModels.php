<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 22-Mar-18
 * Time: 9:28 PM
 */

class BookModels extends models
{
    public function __construct()
    {
        parent::__construct();
    }
    public function listItem($arrayParam, $option)
    {
        if($option == null){

            $result = '';
            $idCate  = isset($arrayParam['category_id']) ? $arrayParam['category_id'] : '';
            $query[] = "SELECT `b`.`id`,`b`.`name`,`b`.`picture`, `b`.`price`, `b`.`category_id`, `c`.`name` AS `name_cate` ";
            $query[] = "FROM `book` AS `b`, `category` AS `c`";
            $query[] = "WHERE `b`.`category_id` = `c`.`id`";
            $query[] = "AND `b`.`status` = '1'";
            if($idCate != ''){
                $query[] = "AND `b`.`category_id` = '$idCate' ";
            }

            $query[] = "ORDER BY `b`.`ordering` ASC";


            $query = implode("", $query);

            return $result = $this->showSelect($query);

        }

    }

    public function showItem($arrayParam, $option)
    {
        if($option == null){

            $result = '';
            $book_id = $arrayParam['book_id'];

            $query[] = "SELECT *";
            $query[] = "FROM `book`";
            $query[] = "WHERE `id` = '$book_id'";
            $query[] = "AND `status` = '1' ";
            $query = implode("", $query);
            return $result = $this->showSelect($query);

        }

    }

    public function showBook($arrParam,$option){

        if($option == 'book-relate'){
            $category_id = $arrParam['category'];
            $book_id     = $arrParam['book_id'];
            $query[] = "SELECT `id`, `name`, `picture`, `price`, `sale_off`, `category_id`";
            $query[] = "FROM `".DS_BOOK."` WHERE `id` <>'".$book_id."'";
            $query[] = "AND `category_id` = '".$category_id."'";
            $query   = implode(' ', $query);
            return $this->showSelect($query);
        }
    }
}