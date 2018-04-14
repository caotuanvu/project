<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 09-Apr-18
 * Time: 9:16 AM
 */

$xhtml = '';
if(!empty($this->listItems)){
    foreach ($this->listItems as $key => $value) {
        $linkCart = URL::setURL('default','user','order',array('book_id' =>  $value['id'],'price' =>  $value['price']));
        $linkBook = URL::setURL('default','book','detail',array('book_id' =>  $value['id'],'category_id' =>  $value['category_id']));
        $fileName = PUBLIC_FILE . FILE_BOOK . DS . $value['picture'];

        $xhtml .= helper::cmsShowInfoItem($value['name'],$linkBook,$linkCart,$fileName,$value['price'],'img-relate col-sm-6');
    }
}else{
    $xhtml = '<p class="text-danger" style="font-size: 20px; font-weight: bold">Dữ liệu đang cập nhật !</p>';
}

echo $xhtml;
?>