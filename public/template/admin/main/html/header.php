<div class="header">
    <div class="header_content">
        Administrations
    </div>
    <div class="header_function">
        <p>Site</p>
        <?php
        $link =  URL::setURL('admin','index','logout');
         ?>
        <p class="left"><i class="fa fa-sign-out sign-out" aria-hidden="true"></i><a href="<?php echo $link;?>">Log-out</a></p>
    </div>
</div>