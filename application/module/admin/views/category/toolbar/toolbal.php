<?php

           //ADD
           $linkAdd     = URL::setURL('admin','category','form');
           $new         =  helper::createToolbar($linkAdd,'fa fa-plus-circle fa-2x','New');

           //PUBLIC
           $linkPublic     = URL::setURL('admin','category','status',array('type'=>1));
           $Public      =  helper::createToolbar($linkPublic,'fa fa-unlock fa-2x','Public','submit');
           //UNPUBLIC

           $linkUnpublic     = URL::setURL('admin','category','status',array('type'=>0));
           $Unpublic    =  helper::createToolbar($linkUnpublic,'fa fa-unlock-alt fa-2x','Unpublic','submit');

           $linkTrash     = URL::setURL('admin','category','trash');
           $Trash       =  helper::createToolbar($linkTrash,'fa fa-trash fa-2x','Trash','submit');

           $linkOrderring   = URL::setURL('admin','category','ordering');
           $checkOrder       =  helper::createToolbar($linkOrderring,'fa fa-check fa-2x','Check','submit');



           //SAVE - ADD
$linkSave     =  URL::setURL('admin','category','form',array('type' => 'save'));
$save         =  helper::createToolbar($linkSave,'fa fa-file-excel-o fa-2x','Save','submit');
//<i class="fa fa-file-powerpoint-o" aria-hidden="true"></i>

$linkSave_close     =  URL::setURL('admin','category','form',array('type' => 'save_close'));
$save_close         =  helper::createToolbar($linkSave_close,'fa fa-file-word-o fa-2x','Save & Close','submit');

// <i class="fa fa-times" aria-hidden="true"></i>
$linkSave_new     =  URL::setURL('admin','category','form',array('type' => 'save_new'));
$save_new         =  helper::createToolbar($linkSave_new,'fa fa-file-image-o fa-2x','Save-New','submit');

$linkClose     =  URL::setURL('admin','category','form',array('type' => 'close'));
$close         =  helper::createToolbar($linkClose,'fa fa-times fa-2x','Close','submit');



$strTool     = '';
switch ($this->action){
     case 'index':
          $strTool = $new. $Public .$Unpublic . $checkOrder . $Trash;
           break;
       case 'form':
           $strTool = $save. $save_close . $save_new . $close;
           break;
   }

?>

<div class="content_header">
    <div class="user">
        <a href=""><i class="fa fa-user-md fa-2x" aria-hidden="true"></i></a>
        User-Manager:: User category
    </div>
    <div class="icon-function">
        <ul>
            <?php echo $strTool;?>
        </ul>
    </div>
</div>