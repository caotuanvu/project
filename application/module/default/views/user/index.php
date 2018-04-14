<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 07-Apr-18
 * Time: 9:22 PM
 */
 $linkChangPass = URL::setURL('default','user','changepass',null,'changepass.html');
 $linkHis        = URL::setURL('default','user','history',null,'history.html');
 $linklogout    = URL::setURL('default','index','logout',null,'logout.html');
 $linkCart      = URL::setURL('default','user','cart',null,'cart.html');
 $arr = array(
     array($linkChangPass,'Change Password','changpass.png'),
     array($linkHis,'History','history.png'),
     array($linklogout,'Logout','logout.png'),
     array($linkCart,'View cart','cart.png'));

$xhtml = '';
foreach ($arr as $value){
    $pathPicture =  PUBLIC_FILE . FILE_FUNCTION . DS . $value[2];
    $xhtml .= '<div class="col-md-2 text-center">
                <a class="text-center" href="'.$value[0].'">'.$value[1].'</a>
                <img src="'.$pathPicture.'" class="img-responsive" title="'.$pathPicture.'" alt="" />
            </div>';
}
 echo $xhtml;
 ?>
