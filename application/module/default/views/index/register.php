<?php

  // PUSH DB FOR INPUT
  $data            = (isset($this->arrParam['form'])) ? $this->arrParam['form'] : '';

  $valueUserName   = (isset($data['username'])) ? $data['username'] : '';
  $valueFullName   = (isset($data['fullname'])) ? $data['fullname'] : '';
  $valueEmail      = (isset($data['email'])) ? $data['email'] : '';
  $valuePass       = (isset($data['password'])) ? $data['password'] : '';

  $ListinputUserName  = helper::createListInputRes('form-group','text','form-control','username','Username',$valueUserName);
  $ListinputFullname  = helper::createListInputRes('form-group','text','form-control','fullname','Fullname',$valueFullName);
  $ListinputPassword  = helper::createListInputRes('form-group','text','form-control','password','Password', $valuePass);
  $ListinputEmail     = helper::createListInputRes('form-group','text','form-control','email','Email',$valueEmail);
  $inputtoken         = helper::createInput('hidden','token',null,null, time());
  $inputSubmit        = helper::createInput('submit','submit',null,'btn btn-default', 'register');

  $link               = URL::setURL('default','index', 'register');

  
?>

<div class="register">
    <div class="tab-content">
        <div class="tab-pane fade in active">
          <?php 
            echo $error = (isset($this->error)) ? $this->error: '';
          ?>
            <h2><span class="glyphicon glyphicon-user"></span>Đăng ký thành viên</h2>
            <form action="<?php echo $link;?>" name="main-form" id="main-form" method="post">
            <?php echo   $ListinputUserName . $ListinputFullname . $ListinputPassword .$ListinputEmail. $inputtoken. $inputSubmit;?>
            </form>
        </div>
     </div>
</div>