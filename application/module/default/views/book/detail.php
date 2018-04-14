<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 08-Apr-18
 * Time: 9:17 AM
 */
$session = Session::get('userInfo');

 $fileName = PUBLIC_FILE . FILE_BOOK . DS . $this->listItems[0]['picture'];

 $des      = $this->listItems[0]['description'];
 $tiles    = $this->listItems[0]['name'];
 $linkCart        = URL::setURL('default','user','order',array('book_id' =>  $this->listItems[0]['id'],'price' =>  $this->listItems[0]['price']));
 $linkRelative    = URL::setURL('default','book','showBook',array('book_id' =>  $this->listItems[0]['id'],'category' =>  $this->listItems[0]['category_id']));

?>
<div class="img-book-detail">
    <div class="col-md-4 col-sm-6">
      <div class="img-detail">
          <img class="img-responsive" width="100%" src="<?php echo $fileName;?>" alt="">
          <p style="font-weight: bold; color: red;"><?php echo $this->listItems[0]['name'];?></p>
      </div>
    </div>

    <div class="col-md-8 col-sm-6">
        <div class="content-detail">
            <h3>Detail</h3>
            <p><?php echo $des?></p>
            <p class="text-danger">Giá sản phẩm: <?php echo number_format($this->listItems[0]['price'])?> vnđ</p>
            <a href="<?php echo $linkCart;?>" class="btn btn-danger">Mua hàng</a>
        </div>
    </div>

</div>

<div class="my-nav col-md-12 col-sm-12">
    <ul class="nav nav-tabs col-sm-12">
        <li class="active"><a data-toggle="tab" href="#detail">Detail</a></li>
        <li><a data-toggle="tab" onclick="javascript:relateBook('<?php echo $linkRelative;?>')" href="#relate">relateve Book</a></li>
    </ul>
    <div class="tab-content">
        <div id="detail" class="tab-pane fade in active">
            <h3>Đánh giá</h3>
            <p><?php echo $des?></p>
        </div>
        <div id="relate" class="tab-pane fade">

        </div>
    </div>
</div>