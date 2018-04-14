<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 09-Apr-18
 * Time: 9:38 PM
 */

$models = new models();
$query  = array();


$result = '';


$query[] = "SELECT `b`.`id`,`b`.`name`,`b`.`picture`, `b`.`price`, `b`.`category_id`, `c`.`name` AS `name_cate`  ";
$query[] = "FROM `book` AS `b`, `category` AS `c`";
$query[] = "WHERE `b`.`category_id` = `c`.`id`";
$query[] = "AND `b`.`status` = '1'";
$query[] = "ORDER BY `b`.`created` DESC";
$query[] = "LIMIT 0 ,2";



 $query = implode(" ", $query);
 $result = $models->showSelect($query);

 $xhtml = '';
foreach ($result as $key => $value) {
    $routerURL   = URL::optimizeText($value['name_cate']).'/'. URL::optimizeText($value['name']). '-'. $value['id']. '-'. $value['category_id']. '.html';

    $pathPicture =  PUBLIC_FILE . FILE_BOOK . DS . $value['picture'];
    $linkCart    = URL::setURL('default','user','order',array('book_id' => $value['id'],'price' => $value['price']));
    $linkDetail  = URL::setURL('default','book','detail',array('book_id' => $value['id'],'category_id' => $value['category_id']),$routerURL);

    $xhtml     .= helper::cmsShowInfoItem($value['name'],$linkDetail,$linkCart,$pathPicture,$value['price'],'img-relate-special col-sm-6');
}

?>
<div class="col-xs-6">
    <h2> <span class="glyphicon glyphicon-th-large"></span>Promosions</h2>
    <?php echo $xhtml;?>
</div>
