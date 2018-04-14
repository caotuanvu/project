<?php

include_once 'toolbar\toolbal.php';
include_once 'submenu\submenu.php';


$data        = $this->arrParam['form'];


$valueName   = (isset($data['username'])) ? $data['username'] : '';
$inputName   = helper::createInput('text','username',30,null,$valueName);
$listName    = helper::createListInput('Username',$inputName);

$valueFName   = (isset($data['fullname'])) ? $data['fullname'] : '';
$inputFullName   = helper::createInput('text','fullname',30,null,$valueFName);
$listFullname    = helper::createListInput('Fullname',$inputFullName);

$valuePass   = (isset($data['password'])) ? $data['password'] : '';
$inputPass   = helper::createInput('password','password',30,null,$valuePass);
$listPassword    = helper::createListInput('Password',$inputPass);

$valueName   = (isset($data['email'])) ? $data['email'] : '';
$inputEmail   = helper::createInput('email','email',30,null,$valueName);
$listEmail    = helper::createListInput('Email',$inputEmail);

$valueOrder      = (isset($data['ordering'])) ? $data['ordering'] : '';
$inputOrdering   = helper::createInput('text','ordering',7,null,$valueOrder);
$listOrdering    = helper::createListInput('Ordering',$inputOrdering);

// ID
$valueID         = (isset($data['id'])) ? $data['id'] : '';

$inputId         = helper::createInput('text','id',3,null,$valueID);
$listId          = helper::createListInput('Id',$inputId);


$arrOptions    = array( 2 => '- Select status -',0 => 'unpublic', 1=> 'public');
$checked       = (isset($data['status'])) ?  $data['status'] : 2;

$inputStatus   = helper::createSelectbox('form[status]',$arrOptions,$checked);
$listStatus    = helper::createListInput('Status',$inputStatus);

$arrOptions    = array( 2 => '- Select group-acp -',0 => 'No', 1=> 'Yes');


//GROUP_NAME
$arrOptions  = $this->group_name;
$checked     = (isset($this->arrParam['form']['group_id'])) ? $this->arrParam['form']['group_id'] : 0;
$selectGroup_name = helper::createSelectbox('form[group_id]', $arrOptions, $checked);
$listGroup_name = helper::createListInput('Group_name', $selectGroup_name);


$inputHiden   = helper::createInput('hidden','taken',null,null,time());


?>
<div class="content_footer">
    <div class="errors">
        <?php
        echo $error = (isset($this->error)) ? $this->error: '';
        $message  = helper::cmsSession();
        echo $message;
        ?>
    </div>
    <form action="#"name="form-add" id="form-add" method="post">
        <div class="row">
            <ul>
               <?php echo $listName. $listFullname.$listPassword .$listEmail. $listStatus.$listGroup_name. $listOrdering.$listId. $inputHiden;?>
            </ul>

        </div>
    </form>
</div>

