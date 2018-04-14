<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 22-Mar-18
 * Time: 9:28 PM
 */

class CategoryModels extends models
{
    public function __construct()
    {
        parent::__construct();
    }
    public function listItem($arrayParam, $option = null)
    {
        $result = '';
        $query[] = "SELECT * ";
        $query[] = "FROM `category`";
        $query[] = "WHERE `id` > 0 ";
        $query[] = "AND `status` = '1' ";

        $query = implode("", $query);
        return $result = $this->showSelect($query);

    }
}