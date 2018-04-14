<?php

$xhtml = '';
$linkSubmit   = URL::setURL('default','user','buy');
$linkContinue = URL::setURL('default','category','index');

$total = 0;
 if(!empty($this->Items)){
     $total      = 0;

     foreach ($this->Items as $key => $value){

         $inputId   = helper::createInput('hidden','form[book_id][]',null,$value['id'],$value['id']);
         $inputName = helper::createInput('hidden','form[name_book][]',null,'',$value['name']);
         $inputPic   = helper::createInput('hidden','form[picture][]',null,$value['id'],$value['picture']);
         $inputPrice   = helper::createInput('hidden','form[price][]',null,$value['id'],$value['prices']);
         $inputQuanti   = helper::createInput('hidden','form[quantities][]',null,$value['id'],$value['quantities']);

         $pathPicture =  PUBLIC_FILE . FILE_BOOK . DS . $value['picture'];
         $total += $value['prices'];
         $xhtml .= '<tr><td>'.$value['id'].'</td>
                     <td><a href="#"><img src="'.$pathPicture.'" title="" width="50" /></a></td>
                     <td>'.$value['name'].'</td>
                     <td>'.$value['quantities'].'</td>
                     <td>'.number_format($value['price_item']).'</td>
                     <td>'.number_format($value['prices']).'</td></tr>';

         $xhtml .= $inputId. $inputName. $inputPic. $inputPrice. $inputQuanti;

     }
// KHI KICK VÀO IMG SẼ ĐẾN DETAIL CỦA QUYỂN SÁCH
 }
?>
<form action="#" name="main-form" id="main-form" method="POST">

<div class="table-responsive">
    <table class="table">
        <thead>
          <tr>
              <th>ID</th>
              <th>Picture</th>
              <th>Name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Total</th>
          </tr>
        </thead>

        <tbody>

             <?php
              echo $xhtml ;
             ?>


        </tbody>


    </table>
    <p class="text-left text-danger pull-right">Tổng tiền: <?php echo number_format($total);?> vnđ</p>

</form>
  <div class="my-syn">
      <div class="col-md-3 pull-left">
          <a href="<?php echo $linkContinue;?>" class="btn btn-danger"><span class="glyphicon glyphicon-menu-left"></span>   Continue</span></a>
      </div>

      <div class="col-md-2 pull-right">
          <a href="#" onclick="javascript:submitForm('<?php echo $linkSubmit;?>')" class="btn btn-danger">Checkout  <span class="glyphicon glyphicon-menu-right"></span></a>
      </div>
  </div>



</div>