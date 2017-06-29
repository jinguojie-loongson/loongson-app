<?php
  include_once('vendor_header.php');
  include_once('_vendor_login.inc');
?>

<div class="login-form" id="register-form">
  <div class="panel panel-primary">
    <div class="panel-heading"> 
      <h3>忘记密码</h3>
    </div>

    <div class="panel-body">
      <form id="forget_form" name="forget_form" method="post" action="findpassword.php" >
       
        <div class="form-group">
          <label>邮箱名:</label> 
          <input id="email_forfind" name="email_forfind" type="text" class="form-control" autocomplete="off" />
        </div>


        <button class="btn btn-primary" id="forgetbtn"  name="forgetbtn"  type="submit">确定</button>
      </form>
    </div>

    <div class="panel-footer">
      <a href="vendor_login.php">返回</a>
    </div>
  </div>

</div>

<?php
  include_once('vendor_footer.php');
?>
