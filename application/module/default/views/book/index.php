<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 22-Mar-18
 * Time: 9:32 PM
 */



  $xhtml = '';
  $category = '';

 if(!empty($this->listItems)){

     $category = $this->listItems[0]['name'];
     foreach ($this->listItems as $key => $value){
         $routerURL   = URL::optimizeText($value['name_cate']).'/'. URL::optimizeText($value['name']). '-'. $value['id']. '-'. $value['category_id']. '.html';
         $pathPicture =  PUBLIC_FILE . FILE_BOOK . DS . $value['picture'];
         $linkCart    = URL::setURL('default','user','order',array('book_id' => $value['id'],'price' => $value['price']));
         $linkDetail  = URL::setURL('default','book','detail',array('book_id' => $value['id'],'category_id' => $value['category_id']),$routerURL);


         $xhtml .= helper::cmsShowInfoItem($value['name'],$linkDetail,$linkCart,$pathPicture,$value['price'],'img-relate col-sm-6');
     }
 }else{
     $xhtml = 'Dữ liệu đang cập nhật !';
 }



?>
<div class="category">
 <h3><span class="glyphicon glyphicon-th-large"></span>   <?php echo $category;?></h3>
<?php echo $xhtml; ?>
</div>
