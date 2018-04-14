<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 22-Mar-18
 * Time: 9:32 PM
 */



  $xhtml = '';
  $session = Session::get('userInfo');
  $classDisible = 'disabled';
  if($session['login'] == 1){
      $classDisible = '';
  }

  foreach ($this->listItems as $key => $value){
      $routerURL     = URL::optimizeText($value->name). '-'. $value->id.'.html';
      $pathPicture =  PUBLIC_FILE . FILE_CATEGORY . DS . $value->picture;
      $link      = URL::setURL('default','book','index',array('category_id' => $value->id),$routerURL);
      $xhtml .= helper::cmsShowCategory($value->name,$link,$pathPicture);
  }

?>
<div class="category row">

<?php echo $xhtml; ?>
</div>
