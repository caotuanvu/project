<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 19-Mar-18
 * Time: 8:46 AM
 */
$linkSubmit = URL::setURL('default','index','login');
?>
  <div class="row">

      <div class="col-md-7">
          <?php
          echo $this->error;
          ?>
      </div>
      <div class="col-md-7" id="form-submit">
          <form action="<?php echo $linkSubmit;?>" id="fom-login" method="post">
              <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter email" name="form[email]">
              </div>
              <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="form[pwd]">
              </div>
              <input type="hidden" value="<?php echo time();?>" name="form[token]">
              <input type="submit" value="login" class="btn btn-default">
          </form>
      </div>
  </div>
