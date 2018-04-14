<?php
 $linkCategory = URL::setURL('admin','group','index');
  $linkBook = URL::setURL('admin','user','index');

?>
<div class="content_center">
    <div class="manage">
        <a href="<?php echo $linkCategory;?>" class="active">Group</a>
        <a href="<?php echo $linkBook;?>">User</a>
    </div>
</div>