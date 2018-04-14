<?php

include_once 'toolbar\toolbal.php';
include_once 'submenu\submenu.php';


$data        = (isset($this->arrParam['form'])) ? $this->arrParam['form'] : '';



$name     = helper::createFormInline('form[name]','text','Name',(isset($data['name'])) ? $data['name'] : '');
$desc     = helper::createFormInline('form[description]','text','Desc',(isset($data['description'])) ? $data['description'] : '');
$price    = helper::createFormInline('form[price]','text','Price',(isset($data['price'])) ? $data['price'] : '');
$sale     = helper::createFormInline('form[sale_off]','text','Sale_off',(isset($data['sale_off'])) ? $data['sale_off'] : '');
$pic      = helper::createFormInline('picture','file','Picture');
$special  = helper::createFormInline('form[special]','text','Special ',(isset($data['special'])) ? $data['special'] : '');
$order    = helper::createFormInline('form[ordering]','text','Ordering ',(isset($data['ordering'])) ? $data['ordering'] : '');





// CREATE STATUS
$arrOptions    = array( 2 => '- Select status -',0 => 'unpublic', 1=> 'public');
$checked       = (isset($data['status'])) ?  $data['status'] : 2;
$listStatus    = helper::createSelectboxRes('status',$arrOptions,'Status',$checked);


// CREATE CATEGORY
$category_name = $this->category_name;
$checked       = (isset($data['category_id'])) ?  $data['category_id'] : 2;
$list_category = helper::createSelectboxRes('category_id',$category_name,'Category',$checked);
$inputHiden    = helper::createInput('hidden','taken',null,null,time());




$inputId = helper::createInput('text', 'id', 3, null, (isset($data['id'])) ? $data['id'] : '');
$listId  = helper::createListInput('Id', $inputId);


?>
<div class="content_footer">
    <div class="errors">
        <?php
        echo $error = (isset($this->error)) ? $this->error: '';
        $message  = helper::cmsSession();
        echo $message;

        ?>
    </div>
    <form action="#"name="form-add" id="form-add" method="post" enctype="multipart/form-data">
        <div class="col-md-7">
            <input type="hidden" size="" value="<?php echo $data['picture'];?>" name="form[picture]" class="">
         <?php
         echo $name . $desc. $pic. $price. $sale. $listStatus. $list_category.$special. $order.$inputHiden;

         ?>
            <?php

            if (isset($data['id']) != '') {

                if (isset($data['picture'])) {
                    $fileName = PUBLIC_FILE . FILE_BOOK . DS . $data['picture'];
                    echo $listId;

                    ?>
                    <label for="img">Picture:</label>
                    <img src="<?php echo $fileName; ?>" width="80px" height="auto" alt="" id="img">
                    <input type="hidden" size="" value="<?php echo $data['picture'] ?>" name="form[vl_picture]">
                <?php }
            }
            ?>
        </div>
    </form>
</div>

