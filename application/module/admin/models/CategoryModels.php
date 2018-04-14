<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 14-Jan-18
 * Time: 5:08 PM
 */

class CategoryModels extends models
{
    protected $_bgName = DS_CATEGORY;
    protected $_picture;

    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->_bgName);

    }

    // COUNT ITEM FOR PANIGATIONS
    public function countItem($arrayParam, $option = null)
    {
        $result = '';
        $query[] = "SELECT COUNT(`id`) AS total ";
        $query[] = "FROM `$this->_bgName`";
        $query[] = "WHERE `id` > 0 ";

        // FILTER VAL
        if (!empty($arrayParam['filter_val'])) {
            $filter = $arrayParam['filter_val'];
            $query[] = "WHERE `name` LIKE '%" . $filter . "%'";
        }
        // FILTER FOR STATUS
        if (isset($arrayParam['filter_select']) && $arrayParam['filter_select'] != 2) {
            $filterSelect = $arrayParam['filter_select'];
            $query[] = "AND `status` ='" . $filterSelect . "'";

        }
        // SORT BY
        if (isset($arrayParam['row_order']) && isset($arrayParam['sort_order'])) {
            $valueSort = $arrayParam['row_order'];
            $sortOrder = $arrayParam['sort_order'];
            $query[] = " ORDER BY `$valueSort` $sortOrder ";
        } else {
            $query[] = " ORDER BY `name` ASC ";
        }
        $query = implode("", $query);
        $result = $this->singleRecord($query);
        return $result['total'];
    }

    // SHOW LIST
    public function listItem($arrayParam, $option = null)
    {
        $result = '';
        $query[] = "SELECT * ";
        $query[] = "FROM `$this->_bgName`";
        $query[] = "WHERE `id` > 0 ";

        // FILTER VAL
        if (!empty($arrayParam['filter_val'])) {
            $filter = $arrayParam['filter_val'];
            $query[] = "AND `name` LIKE '%" . $filter . "%'";
        }
        // FILTER FOR STATUS
        if (isset($arrayParam['filter_select']) && $arrayParam['filter_select'] != 2) {
            $filterSelect = $arrayParam['filter_select'];
            $query[] = "AND `status` ='" . $filterSelect . "'";
        }

        // SORT BY
        if (isset($arrayParam['row_order']) && isset($arrayParam['sort_order'])) {
            $valueSort = $arrayParam['row_order'];
            $sortOrder = $arrayParam['sort_order'];
            $query[] = " ORDER BY `$valueSort` $sortOrder ";
        } else {
            $query[] = " ORDER BY `id` DESC ";
        }
        if (isset($arrayParam['panigation'])) {
            $pagePanigation = $arrayParam['panigation'];
            $positon = ($pagePanigation['currentPage'] - 1) * $pagePanigation['totalItemPerPage'];
            $query[] = "LIMIT $positon," . $pagePanigation['totalItemPerPage'];
        }

        if($option['task'] == 'list-category-xml'){
            $query = "SELECT `id`, `name`, `picture` FROM `$this->_bgName` WHERE `status` = '1'";
            return $this->showSelect($query);
        }
         $query = implode("", $query);
        return $result = $this->showSelect($query);

    }


    // PROCESS JAX
    public function changeStatusIcons($arrayParam, $option = null)
    {
        require_once SCRIPT.DS.'categoryXMl.php';
        // AJAX STATUS
        if ($option['task'] == 'change-ajax-status') {
            $status = ($arrayParam['status'] == 1) ? 0 : 1;
            $id    = $arrayParam['id'];
            $query = "UPDATE `$this->_bgName` SET `status` ='" . $status . "' WHERE id='" . $id . "'";
            $this->query($query);
            $linkStatus = URL::setURL('admin', 'category', 'editStatus', array('id' => $id, 'status' => $status));

            $XMLcate = $this->listItem($arrayParam,array('task' => 'list-category-xml'));
            categoryXML::setCategoryXML($XMLcate,'category.xml');

            return array($id, $status, $linkStatus);

        }

        // AJAX PUBLIC - UNPUPLIC STATUS
        if ($option['task'] == 'change-submit-status') {
            $status = $arrayParam['type'];
            if (!empty($arrayParam['checbox'])) {
                $cId = $this->setWhereDelete($arrayParam['checbox']);
                $query = "UPDATE `$this->_bgName` SET `status` ='" . $status . "' WHERE `id` IN ($cId)";

                $XMLcate = $this->listItem($arrayParam,array('task' => 'list-category-xml'));
                categoryXML::setCategoryXML($XMLcate,'category.xml');
                $this->query($query);
                Session::set('message', array('class' => 'success', 'content' => 'Có ' . $this->showAffectedRow() . ' phần tử được thay đổi trạng thái!'));
            } else {
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn trạng thái thay đổi!'));
            }
        }
    }
// TRASH ELEMENT
    public function TrashElement($arrayParam, $option = null)
    {
        if ($option == null) {
            require_once SCRIPT.DS.'categoryXMl.php';


//            $query  = "SELECT `picture`  FROM `".DS_CATEGORY."` WHERE `id` IN ($cId)";
//            $result = $this->showSelects($query);

            $this->delete($arrayParam['checbox']);
            $XMLcate = $this->listItem($arrayParam,array('task' => 'list-category-xml'));
            categoryXML::setCategoryXML($XMLcate,'category.xml');

        }
    }

    // UPDATE ORDERING
    public function CheckOrdering($arrParam)
    {
        if (!empty($arrParam['order'])) {
            foreach ($arrParam['order'] as $id => $value) {
                $query = "UPDATE `$this->_bgName` SET `ordering` ='" . $value . "' WHERE id='" . $id . "'";
                $this->query($query);
            }
        }
    }


    // SHOW ITEM
    public function showItem($arrParam)
    {

        $query[] = "SELECT `id`, `name`, `ordering`, `status`, `picture`";
        $query[] = " FROM `$this->_bgName`";
        $query[] = "WHERE `id` ='" . $arrParam . "'";
        $query = implode("", $query);
        return $this->singleRecord($query);

    }


    public function saveItem($arrParam, $option)
    {
        require_once SCRIPT.DS.'setPicture.php';
        require_once SCRIPT.DS.'categoryXMl.php';

        $this->_picture      = new setPicture();

        $SessionUser             = Session::get('userInfo');
        $arrParam['modified_by'] = $SessionUser['info']['username'];
        $arrParam['created_by']  = $SessionUser['info']['username'];
        if ($option['task'] == 'add') {
            unset($arrParam['vl_picture']);
            $arrParam['picture'] = $this->_picture->fetchNamePicture($arrParam['picture'],FILE_CATEGORY);
            $this->setInsert($arrParam);

            //////////CATEGORY XML////////////////////////
            $XMLcate = $this->listItem($arrParam,array('task' => 'list-category-xml'));
            categoryXML::setCategoryXML($XMLcate,'category.xml');

            Session::set('message', array('class' => 'success', 'content' => 'Đã thêm mới thành công '));
        }

        if ($option['task'] == 'edit') {
            echo "edit";
            if( $arrParam['picture']['name'] == '') {
                unset($arrParam['picture']);
            }else{
                $arrParam['picture'] = $this->_picture->fetchNamePicture($arrParam['picture'],FILE_CATEGORY);

            }

            if(isset($arrParam['picture']) == true){
                setPicture::deletePicture($arrParam['vl_picture']);
            }
            unset($arrParam['vl_picture']);
            $this->UpdateElement($arrParam,$arrParam['id']);

            $XMLcate = $this->listItem($arrParam,array('task' => 'list-category-xml'));
            categoryXML::setCategoryXML($XMLcate,'category.xml');
        }

    }
}