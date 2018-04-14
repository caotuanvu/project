<?php
include_once 'toolbar\toolbal.php';
include_once 'submenu\submenu.php';

$data        = $this->arrParam['form'];

$valueName   = (isset($data['name'])) ? $data['name'] : '';
$inputName   = helper::createInput('text','name',30,null,$valueName);
$listName    = helper::createListInput('Name',$inputName);

$valueOrder   = (isset($data['ordering'])) ? $data['ordering'] : '';
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

$checked       = (isset($data['group_acp'])) ? $data['group_acp'] : 2;
$inputGroup_acp   = helper::createSelectbox('form[group_acp]',$arrOptions,$checked);
$listGroup_ACP    = helper::createListInput('Group_ACP',$inputGroup_acp);

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
               <?php echo $listName. $listStatus.$listGroup_ACP. $listOrdering.$listId. $inputHiden;?>
            </ul>

        </div>
    </form>
</div>

