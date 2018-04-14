   <!-- THANH ĐIỀU HƯỚNG -->

   <?php

   $arrMenu    = array();
   $linkHome   = URL::setURL('default','index','index',null,'index.html');
   $linkCate   = URL::setURL('default','category','index',null,'category.html');
   $linkLogout = URL::setURL('default','index','logout',null,'logout.html');

   $linkaccount= URL::setURL('default', 'user', 'index',null,'account.html');

   $linkControll   = URL::setURL('admin','index','index',null,'control.html');

   $linkRegister   = URL::setURL('default','index','register',null,'register.html');

   $linklogin   = URL::setURL('default','index','login',null,'login.html');
   $linkHome   = URL::setURL('default','index','index',null,'index.html');



   $arrMenu[]  = array('link' => $linkHome, 'class' => 'index-index','name' => 'Home');
   $arrMenu[]  = array('link' => $linkCate, 'class' => 'category-index book-index','name' => 'Category');

   if(isset($_SESSION['userInfo']['login']) == 1) {
       $logged    = ($_SESSION['userInfo']['login'] == 1);
       $group_acp = $_SESSION['userInfo']['group_acp'];
       if($logged == true){
           $arrMenu[] = array('link' => $linkaccount, 'class' => 'user-index user-history user-cart', 'name' => 'Myaccout');
           $arrMenu[] = array('link' => $linkLogout, 'class' => 'logout-index', 'name' => 'Logout');
           if($group_acp == 1){
               $arrMenu[] = array('link' => $linkControll, 'class' => 'index', 'name' => 'my Admin');
           }
       }



   }else{
       $arrMenu[] =  array('link' => $linkRegister, 'class' => 'index-register', 'name' => 'Register');
       $arrMenu[] =  array('link' => $linklogin, 'class' => 'index-login', 'name' => 'Login');
   }

   $xhtml = '';
   foreach ($arrMenu as $key => $value) {
       $xhtml .= '<li ><a  onclick="move()" class="' . $value['class'] . '" href="' . $value['link'] . '">' . $value['name'] . '</a></li>';
   }
   ?>
   <div class="my-navbar">
    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>           
        </button>

        <a class="navbar-brand" href="<?php echo $linkHome;?>">
		      	Tuấn Vũ Store
		      </a>
        </div>
        
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right" id="menuList">
             <?php echo $xhtml; ?>
           </ul>
        </div>
        </nav>
     </div>
<script type="text/javascript">
    $(document).ready(function(){
        var controller   = '<?php echo $this->arrParam['controller']; ?>';
        var action       = '<?php echo $this->arrParam['action']; ?>';

    	var className     = controller + '-' + action;
    	console.log(className);

    	$("#menuList li a." + className).addClass('active');
    });
</script>