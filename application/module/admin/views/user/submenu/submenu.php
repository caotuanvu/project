<?php
 $linkCategory = URL::setURL('admin','group','index');
  $linkBook = URL::setURL('admin','user','index');

?>
<div class="content_center">
    <div class="manage">
        <a href="<?php echo $linkCategory;?>">Group</a>
        <a href="<?php echo $linkBook;?>" class="active">User</a>
    </div>
</div>