<?php
 $linkCategory = URL::setURL('admin','category','index');
  $linkBook = URL::setURL('admin','book','index');

?>
<div class="content_center">
    <div class="manage">
        <a href="<?php echo $linkCategory;?>" >Category</a>
        <a href="<?php echo $linkBook;?>" class="active">Book</a>
    </div>
</div>