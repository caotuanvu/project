<?php
include_once 'toolbar\toolbal.php';
include_once 'submenu\submenu.php';


$data = (isset($this->arrParam['form'])) ? $this->arrParam['form'] : '';

///////////////////////VALUE INPUT////////////////////////
$NAME     = (isset($data['name']) == 1) ? $data['name'] : '';
$ID       = (isset($data['id']) == 1) ? $data['id'] : '';
$ORDERING = (isset($data['ordering']) == 1) ? $data['ordering'] : '';
$STATUS   = (isset($data['status']) == 1) ? $data['status'] : 2;
///////////////////////////VALUE INPUT/////////////////////////

$inputId = helper::createInput('text', 'id', 3, null, $ID);
$listId  = helper::createListInput('Id', $inputId);

$arrOptions = array(2 => '- Select status -', 0 => 'unpublic', 1 => 'public');
$inputStatus = helper::createSelectbox('form[status]', $arrOptions, $STATUS);
$listStatus = helper::createListInput('Status', $inputStatus);


?>
<div class="content_footer">
    <div class="errors">
        <?php
        echo $error = (isset($this->error)) ? $this->error : '';
        $message = helper::cmsSession();
        echo $message;
        ?>
    </div>
    <form action="#" name="form-add" id="form-add" method="post" enctype="multipart/form-data">
        <div class="row">
            <form action="#" name="main-form" id="form-add" method="post" id="form-add" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="form[name]" value="<?php echo $NAME ?>">
                </div>
                <div class="form-group">
                    <label for="ordering">ordering:</label>
                    <input type="text" class="form-control" id="ordering" name="form[ordering]"
                           value="<?php echo $ORDERING ?>">
                </div>

                <div class="form-group">
                    <?php echo $listId . $listStatus ?>
                </div>
                <div class="form-group">
                    <label for="picture">Picture:</label>
                    <input type="file" class="form-control" id="email" name="picture"/>
                </div>
                <div class="form-group">
                    <?php

                    if (isset($data['id']) != '') {
                        if (isset($data['picture'])) {
                            $fileName = PUBLIC_FILE . FILE_CATEGORY . DS . $data['picture'];

                            ?>
                            <label for="img">Picture:</label>
                            <img src="<?php echo $fileName; ?>" width="80px" height="auto" alt="" id="img">
                            <input type="hidden" size="" value="<?php echo $data['picture'] ?>" name="form[vl_picture]">
                        <?php }
                    }
                    ?>
                </div>
                <input type="hidden" size="" value="<?php echo time(); ?>" name="form[taken]" class="">

            </form>
        </div>
    </form>
</div>

