
<?php

$message = '';

 switch ($this->arrParam['type']){
     case 'not-permission':
          $message = 'Bạn không có quyền truy cập chức năng này !';
          break;
     case 'sucess':
         $message = 'Đăng ký thành công vui lòng đợt quản trị phê duyệt !';
         break;
     case 'not-login':
         $message = 'Du lieu khong hop le';
         break;
  }
?>
<div class="panel-group">
    <div class="panel panel-primary" id="my-panel-group">
      <div class="panel-heading"><?php echo $message?></div>
    </div>
</div>