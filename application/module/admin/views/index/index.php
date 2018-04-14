<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 19-Mar-18
 * Time: 8:46 AM
 */
 $imgURL = $this->_image. 'header'. DS;

  $dirArrray = array(
        array('link' => URL::setURL('admin','book','add'),'name' => 'Add new book','image' => 'icon-48-article-add'),
        array('link' => URL::setURL('admin','book','index'),'name' => 'Book manage','image' => 'icon-48-article'),
        array('link' => URL::setURL('admin','category','index'),'name' => 'Category','image' => 'icon-48-banner-categories'),
        array('link' => URL::setURL('admin','group','index'),'name' => 'Group manage','image' => 'icon-48-category'),
        array('link' => URL::setURL('admin','user','index'),'name' => 'User manage','image' => 'icon-48-user')
  );
 $xhtml = '';
  foreach ($dirArrray as $key => $value)
    {
      $xhtml .= ' <div class="col-md-2 text-center col-sm-5" id="index-condition">
                    <a href="'.$value['link'].'"><img width="30%" src="'.$imgURL.$value['image'].'.png"></a>
                    <p>'.$value['name'].'</p>
                </div>';
    }
      ?>


<div class="row" id="my-row">
    <?php echo $xhtml;?>
</div>
