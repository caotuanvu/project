<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 19-Jan-18
 * Time: 8:19 PM
 */

class helper
{
    // tạo ra các icon
    public static function createToolbar($link,$class,$context,$type='new')
    {
        $xhtml = '<li>';
        if($type== 'new') {
            $xhtml .= '<a href="' . $link . '"><i class="' . $class . '" aria-hidden="true"></i></a><p>' . $context . '</p>';
        }elseif ($type == 'submit'){
            $xhtml .= '<a href="#"><i class="' . $class . '" aria-hidden="true" onclick="javascript:submitForm(\''.$link.'\')"></i></a><p>' . $context . '</p>';
        }
        $xhtml .= '</li>';
        return $xhtml;
    }

    public static function formatDate($date){
        $xhtml = '';
         if($date != '0000-00-00'){
            $xhtml = date('d-m-Y',strtotime($date));
         }
         return $xhtml;
    }

    // create status
    public static function cmsStatus($valueStatus,$link,$id){
        $xhtml = '';
        $status = 'fa fa-dot-circle-o';
        if($valueStatus == 1){
            $status = 'fa fa-check-square';
        }
        $xhtml = '<a id="status-'.$id.'" href="javascript:changeStatus(\''.$link.'\')"><span class="'.$status.'" aria-hidden="true"></span></a>';
        return $xhtml;
    }

    // create input

    public static function createInput($type,$name=null,$size=null,$class = null, $value=null, $disabled=null){
      return  $xhtml = '<input type="'.$type.'" size="'.$size.'" value="'.$value.'" '.$disabled.' name="'.$name.'" class="'.$class.'" />';
    }


    public static function createListInput($lbName,$input){
        return  $xhtml = '<li><lable  class="col-md-2">'.$lbName.'</lable>'.$input.'</li>';
    }
    //responsive

    public static function createListInputRes($classParent,$type,$class,$name,$lable,$value=null){
        return $xhtml = '<div class="'.$classParent.'">
                        <label for="'.$name.'">'.$lable.':</label>
                        <input type="'.$type.'" class="'.$class.'" id="'.$name.'"  name="form['.$name.']" value="'.$value.'">
                     </div>';
    }


    public static function createFormInline($name,$type,$label,$value = null, $size = null){
        return $xhtml =  '<div class="form-group my-form">
                              <label class="control-label col-sm-2" for="'.$name.'">'.$label.':</label>
                              <div class="col-sm-10">
                                <input type="'.$type.'" size="'.$size.'" value="'.$value.'" class="form-control" id="'.$name.'" name="'.$name.'" placeholder="Enter '.$name.'...">
                              </div>
                           </div>';
    }

    // create SESSION
    public static function cmsSession(){
        $message = '';
        if(!empty($_SESSION['message'])){
            $message .= '<div class="text-success h1 '.$_SESSION['message']['class'].'">'.$_SESSION['message']['content'].'</div>';
        }
        Session::delete('message');
        return $message;
    }

    // create cmsGroup_acp
    public static function cmsGroupAcp($valueGroup_acp,$link,$id){
        $xhtml = '';
        $group_acp = 'fa fa-dot-circle-o';
        if($valueGroup_acp == 1){
            $group_acp = 'fa fa-check-square';
        }
        $xhtml = '<a id="group_acp-'.$id.'" href="javascript:changeGroupACP(\''.$link.'\')">
                               <span class="'.$group_acp.'" aria-hidden="true"></span>
                  </a>';
        return $xhtml;

    }

    // sap xep

    public static function sortOrderBy($name,$value,$valueSort,$sortBy){
     $span    = '';
     $sortByVali   = ($sortBy == 'ASC') ? 'down' : 'up';// trương hợp ngoại lệ
     $sortBySubmit = ($sortBy == 'ASC') ? 'DESC' : 'ASC';
     if($value == $valueSort){
         $span = '<span class="fa fa-caret-square-o-'.$sortByVali.'" aria-hidden="true"></span>';
     }
     $xhtml = '<a href="#" onclick="javascript:submit(\''.$value .'\',\''.$sortBySubmit.'\')">'.$name.'</a>&nbsp;'.$span;
     return $xhtml;
    }

    // CREATE SELECT BOX
    public static function createSelectbox($name,$arrOption,$checkked = 2){
        $xhtml = '<select name="'.$name.'">';
        if(!empty($arrOption)){
            foreach ($arrOption as $key => $value) {
                if($checkked == $key){
                    $xhtml .= '<option selected="selected" value="'.$key.'">'.$value.'</option>';
                }else{
                    $xhtml .= '<option  value="'.$key.'">'.$value.'</option>';
                }
            }
        }
        $xhtml .= '</select>';
        return $xhtml;
    }

    // CREATE SELECT BOX
    public static function createSelectboxRes($name,$arrOption,$lable,$checkked){
        $xhtml = '<div class="form-group form-select">
                        <label for="'.'.$name.'.'" class="control-label col-sm-2">'.$lable.'</label>
                        <div class="col-sm-6"><select class="form-control input-sm" name="form['.$name.']" id="'.$name.'">';
            if(!empty($arrOption)){
                foreach ($arrOption as $key => $value) {
                    if($checkked == $key){
                        $xhtml .= '<option selected="selected" value="'.$key.'">'.$value.'</option>';
                    }else{
                        $xhtml .= '<option  value="'.$key.'">'.$value.'</option>';
                    }
                }
            }
        $xhtml .= '</select></div></div>';
        return $xhtml;
    }

    public static function createTextArea($name,$label, $row = 3,$value = null){
        return $xhtml =  '<div class="form-group my-form">
                              <label class="control-label col-sm-2" for="'.$name.'">'.$label.':</label>
                              <div class="col-sm-10">
                                <textarea class="form-control" value="'.$value.'" id="'.$name.'" rows="'.$row.'" name="form['.$name.']" placeholder="Enter '.$name.'..."></textarea>
                              </div>
                           </div>';
    }

    public static function  cmsShowInfoItem($title,$linkBook,$link,$image,$price,$class){
      return $xhtml = '<div class="'.$class.'">
                <div class="title_book"><a href="'.$linkBook.'" class="title_detail">'.$title.'</a></div>
                <div class="img-book">
                    <img width="100%" class="img-responsive" src="'.$image.'" alt="">
                </div>
                 <p>Price: '.number_format($price).'</p>
                <p><a href="'.$link.'" class="cart btn btn-danger text-center">Mua hàng</a></p>
            </div>';
    }

    public static function  cmsShowCategory($title,$link,$image){
        return $xhtml = '<div class="img-relate col-sm-6">
                <div class="title_book"><a href="'.$link.'" class="title_detail">'.$title.'</a></div>
                <div class="img-book">
                    <img class="img-responsive" src="'.$image.'" alt="">
                </div>
            </div>';
    }




}