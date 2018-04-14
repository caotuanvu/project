<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 14-Jan-18
 * Time: 5:08 PM
 */

class GroupModels extends models
{
    protected $_bgName = DS_TABLE;

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

        // FILTER FOR GROUP_ACP
        if (isset($arrayParam['group_acp']) && $arrayParam['group_acp'] != 2) {
            $filterGroup_acp = $arrayParam['group_acp'];
            $query[] = "AND `group_acp` ='" . $filterGroup_acp . "'";
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
         $query = implode("", $query);

        return $result = $this->showSelect($query);

    }


    // PROCESS JAX
    public function changeStatusIcons($arrayParam, $option = null)
    {

        // AJAX STATUS
        if ($option['task'] == 'change-ajax-status') {
            $status = ($arrayParam['status'] == 1) ? 0 : 1;
            $id    = $arrayParam['id'];
            $query = "UPDATE `$this->_bgName` SET `status` ='" . $status . "' WHERE id='" . $id . "'";
            $this->query($query);
            $linkStatus = URL::setURL('admin', 'group', 'editStatus', array('id' => $id, 'status' => $status));
            return array($id, $status, $linkStatus);
        }
        // AJAX GROUP_ACP
        if ($option['task'] == 'change-ajax-group_acp') {
            $group_acp = ($arrayParam['group_acp'] == 1) ? 0 : 1;
            $id = $arrayParam['id'];
            $query = "UPDATE `$this->_bgName` SET `group_acp` ='" . $group_acp . "' WHERE id='" . $id . "'";
            $this->query($query);
            $linkGroup_acp = URL::setURL('admin', 'group', 'editGroupACP', array('id' => $id, 'group_acp' => $group_acp));
            return array($id, $group_acp, $linkGroup_acp);
        }

        // AJAX PUBLIC - UNPUPLIC STATUS
        if ($option['task'] == 'change-submit-status') {
            $status = $arrayParam['type'];
            if (!empty($arrayParam['checbox'])) {
                $cId = $this->setWhereDelete($arrayParam['checbox']);
                $query = "UPDATE `$this->_bgName` SET `status` ='" . $status . "' WHERE `id` IN ($cId)";
                $this->query($query);
                Session::set('message', array('class' => 'success', 'content' => 'Có ' . $this->showAffectedRow() . ' phần tử được thay đổi trạng thái!'));
            } else {
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn trạng thái thay đổi!'));
            }
        }
    }

//    public function TrashElement($arrayParam, $option = null)
//    {
//        if ($option == null) {
//            $cId = $arrayParam['checbox'];
//
//            $this->delete($cId);
//        }
//    }

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
    public function editItem($arrParam)
    {

        $query[] = "SELECT `id`, `name`, `ordering`, `group_acp`, `status`";
        $query[] = " FROM `$this->_bgName`";
        $query[] = "WHERE `id` ='" . $arrParam . "'";
        $query = implode("", $query);
        return $this->singleRecord($query);


    }


//    public function saveItem($arrParam, $option)
//    {
//
//        if ($option['task'] == 'add') {
//            $this->setInsert($arrParam);
//            Session::set('message', array('class' => 'success', 'content' => 'Đã thêm mới thành công '));
//        }
//
//        if ($option['task'] == 'edit') {
//            $where = array(array('id', $arrParam['id']));
//            if (!$this->Update($this->Update($arrParam, $where))) {
//                Session::set('message', array('class' => 'error', 'content' => 'Dữ liệu cập nhật bị lỗi '));
//            } else {
//                Session::set('message', array('class' => 'success', 'content' => 'Đã cập nhật thành công '));
//            }
//
//        }
//
//    }
}