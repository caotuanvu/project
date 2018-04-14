<?php
require_once SCRIPT. DS.'categoryXML.php';
$result = categoryXML::getCategoryXML('category.xml');



$xhtml = '';

 $categoryId = isset($this->arrParam['category_id']) ? $this->arrParam['category_id'] : '';


 foreach ($result as $key => $value){
     $routerURL     = URL::optimizeText($value->name). '-'. $value->id.'.html';

     $url = URL::setURL('default','book','index',array('category_id' => $value->id),$routerURL);


     if($categoryId == $value->id){
         $xhtml .= '<li ><a class="active" target="_blank" href="'.$url.'">'.$value->name.'</a></li>';
     }else{
         $xhtml .= '<li><a target="_blank" href="'.$url.'">'.$value->name.'</a></li>';
     }


 }

?>

<div class="menu-list">
    <div class="category">
        <span class="glyphicon glyphicon-th-list"></span>  Category
    </div>
    <ul class="list">
    <?php echo $xhtml;?>
    </ul>
</div>