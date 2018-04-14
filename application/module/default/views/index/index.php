
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="item active">
            <img src="<?php echo FOLDER_IMG. DS;?>carousel/business_website_templates_1.jpg" alt="Chania" >
            <div class="carousel-caption">
               <h3>Tuấn Vũ store</h3>
            </div>
        </div>

        <div class="item">
            <img src="<?php echo FOLDER_IMG. DS;?>carousel/business_website_templates_2.jpg" alt="Chania" >
            <div class="carousel-caption">

            </div>
        </div>

        <div class="item">
            <img height="300px" src="<?php echo FOLDER_IMG. DS;?>carousel/business_website_templates_3.jpg" alt="Chania" >
            <div class="carousel-caption">

            </div>
        </div>

        <div class="item">
            <img src="<?php echo FOLDER_IMG. DS;?>carousel/business_website_templates_4.jpg" alt="Chania" >
            <div class="carousel-caption">

            </div>
        </div>

        <div class="item">
            <img src="<?php echo FOLDER_IMG. DS;?>carousel/business_website_templates_5.jpg" alt="Chania" >
            <div class="carousel-caption">

            </div>
        </div>
    </div>

    <div class="control-carulsel">
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

  <div class="book_new">
      <?php
      $xhtml = '';

      foreach ($this->listItems as $key => $value){

          $pathPicture =  PUBLIC_FILE . FILE_BOOK . DS . $value['picture'];
          $linkCart    = URL::setURL('default','user','order',array('book_id' => $value['id'],'price' => $value['price']));
          $linkDetail  = URL::setURL('default','book','detail',array('book_id' => $value['id'],'category_id' => $value['category_id']));

          $xhtml .= helper::cmsShowInfoItem($value['name'],$linkDetail,$linkCart,$pathPicture,$value['price'],'img-relate col-sm-6 col-md-3');
      }
      ?>
      <h2 style="font-weight: bold; background: #d0e9c6; color: red;  text-shadow: 2px 2px #FF0000; padding: 10px; display: inline-block"> <span class="glyphicon glyphicon-hand-right"></span>   Product New</h2>

      <div class="product">
          <?php echo $xhtml;?>
      </div>

  </div>
