<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 14-Jan-18
 * Time: 5:08 PM
 */

class BookModels extends models
{
    protected $_bgName = DS_BOOK;
    private $_arrDB = array('name','special','picture','vl_picture','description','created','modified','created_by','modified_by','price','sale_off','category_id');
  public function __construct()
  {
      parent::__construct();
      $this->setTable($this->_bgName);


  }
    // COUNT ITEM FOR PANIGATIONS
    public function countItem($arrayParam,$option=null){
        $result = '';
        $query[] = "SELECT COUNT(`id`) AS total ";
        $query[] = "FROM `$this->_bgName`";
        $query[] = "WHERE `id` > 0 ";


        // FILTER VAL
        $flagWher = false;
        if(!empty($arrayParam['filter_val'])){
            $filter  = $arrayParam['filter_val'];
            $query[] =  "AND `name` LIKE '%".$filter."%'";
        }
        // FILTER FOR STATUS
        if(isset($arrayParam['filter_select']) && $arrayParam['filter_select'] != 2){
            $filterSelect  = $arrayParam['filter_select'];
            $query[]       =  "AND `status` ='".$filterSelect."'";

        }
        //  REPLACE BANGWFG CATEGORY_ID
        if(isset($arrayParam['filter_group']) && $arrayParam['filter_group'] != 0){
            $filterGroup_name   = $arrayParam['filter_group'];
            $query[]            =  " AND u.`id` ='".$filterGroup_name."'";
        }
        // SORT BY
        if(isset($arrayParam['row_order']) && isset($arrayParam['sort_order'])){
            $valueSort = $arrayParam['row_order'];
            $sortOrder = $arrayParam['sort_order'];
            $query[] = " ORDER BY `$valueSort` $sortOrder ";
        }else{
            $query[] = " ORDER BY `name` ASC ";
        }

        $query   = implode("",$query);
        $result = $this->singleRecord($query);

        return $result['total'];
    }
  // SHOW LIST
  public function listItem($arrayParam,$option=null){
      $result = '';
      $query[] = "SELECT `b`.`id`,`b`.`name`,`b`.`description`, `b`.`picture`,`b`.`modified`,`b`.`price`,`b`.`sale_off`, `b`.`modified_by`, `b`.`created`,`b`.`created_by`, `b`.`status`, `b`.`ordering`,`b`.`special`, `c`.`name` AS 'category' ";
      $query[] = "FROM `$this->_bgName` AS b , `".DS_CATEGORY."` AS c  WHERE  ";
      $query[] = "b.`category_id` = c.`id`";
      $query[] = "AND b.`id`> '0'";

      // FILTER VAL
       if(!empty($arrayParam['filter_val'])){
           $filter  = $arrayParam['filter_val'];
          $query[] =  " AND b.`name` LIKE '%".$filter."%'";
       }

      // FILTER FOR STATUS
      if(isset($arrayParam['filter_select']) && $arrayParam['filter_select'] != 2){
          $filterSelect  = $arrayParam['filter_select'];
          $query[]       =  " AND b.`status` ='".$filterSelect."'";
      }

      // FILTER CATEGORY
      if(isset($arrayParam['filter_group']) && $arrayParam['filter_group'] != 0){
          $filterCategory     = $arrayParam['filter_group'];
          $query[]            =  " AND b.`id` ='".$filterCategory."'";
      }

      // SORT BY
      if(isset($arrayParam['row_order']) && isset($arrayParam['sort_order'])){
          $valueSort = $arrayParam['row_order'];
          $sortOrder = $arrayParam['sort_order'];
          $query[] = " ORDER BY b.`$valueSort` $sortOrder ";
      }else{
          $query[] = " ORDER BY b.`id` DESC ";
      }
       if(isset($arrayParam['panigation'])){
           $pagePanigation     = $arrayParam['panigation'];
           $positon            = ($pagePanigation['currentPage'] - 1) * $pagePanigation['totalItemPerPage'];
           $query[]            = "LIMIT $positon,".$pagePanigation['totalItemPerPage'];
       }
     $query   = implode("",$query);

     return $result = $this->showSelect($query);

  }


  // PROCESS JAX
  public  function changeStatusIcons($arrayParam,$option=null){
      // AJAX STATUS
      if($option['task'] =='change-ajax-status'){
          $status = ($arrayParam['status'] == 1) ? 0 : 1;
          $id     = $arrayParam['id'];
          $query = "UPDATE `$this->_bgName` SET `status` ='".$status."' WHERE id='".$id."'";
          $this->query($query);
          $linkStatus = URL::setURL('admin','group','editStatus',array('id'=> $id,'status'=> $status));
          return array($id,$status,$linkStatus);
      }


      // AJAX PUBLIC - UNPUPLIC STATUS
      if($option['task'] =='change-submit-status'){
          $status  =  $arrayParam['type'];
          if(!empty($arrayParam['checbox'])){
              $cId = $this->setWhereDelete($arrayParam['checbox']);
              $query = "UPDATE `$this->_bgName` SET `status` ='".$status."' WHERE `id` IN ($cId)";
              $this->query($query);
              Session::set('message', array('class' => 'success', 'content' => 'Có ' . $this->showAffectedRow(). ' phần tử được thay đổi trạng thái!'));
          }else{
              Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn trạng thái thay đổi!'));
          }
      }
  }

  public function TrashElement($arrayParam,$option =null)
  {
      if ($option == null) {
          $cId = $arrayParam['checbox'];
        // Remove image
          require_once SCRIPT.DS.'setPicture.php';

          $idDe = $this->setWhereDelete($arrayParam['checbox']);
          $query		= "SELECT `id`, `picture` AS `name` FROM `$this->table` WHERE `id` IN ($idDe)";
          $arrImage	    = $this->fetchQuery($query);

          foreach ($arrImage as $value){
              setPicture::deletePicture(DS_BOOK,$value);
          }



          $this->delete($cId);
      }
  }

  // UPDATE ORDERING
  public function CheckOrdering($arrParam){
      if(!empty($arrParam['order'])){
          foreach ($arrParam['order'] as $id => $value) {
              $query = "UPDATE `$this->_bgName` SET `ordering` ='".$value."' WHERE id='".$id."'";
              $this->query($query);
          }
      }
  }


    // SHOW ITEM
    public function editItem($id){

        $query[] = "SELECT * FROM `$this->_bgName` WHERE `id` = '". $id. "'";
        $query   = implode("",$query);
        return $this->singleRecord($query);


    }

    public function showGroupName()
    {
        $query[] = "SELECT `name`, `id`";
        $query[] = " FROM `".DS_CATEGORY."`";
         $query   = implode("",$query);

         $result   = $this->fetchQuery($query);
         $result[0] = '-- select group--';
         return $result;
    }

  public function saveItem($arrParam,$option)
  {
      require_once SCRIPT.DS.'setPicture.php';
      $this->_picture      = new setPicture();

      $SessionUser             = Session::get('userInfo');
      $arrParam['modified_by'] = $SessionUser['info']['username'];
      $arrParam['created_by']  = $SessionUser['info']['username'];


      if ($option['task'] == 'add') {

          unset($arrParam['vl_picture']);
          $arrParam['picture'] = $this->_picture->fetchNamePicture($arrParam['picture'],FILE_BOOK);

          $this->setInsert($arrParam);
          Session::set('message', array('class' => 'success', 'content' => 'Đã thêm mới thành công '));
      }

      if ($option['task'] == 'edit') {

          if( $arrParam['picture']['name'] == '') {
              unset($arrParam['picture']);
          }else{
              $arrParam['picture'] = $this->_picture->fetchNamePicture($arrParam['picture'],FILE_BOOK);

          }

          if(isset($arrParam['picture']) == true) {
//              setPicture::deletePicture($arrParam['vl_picture']);
          }

          unset($arrParam['vl_picture']);

          $this->UpdateElement($arrParam,$arrParam['id']);

      }
  }
}