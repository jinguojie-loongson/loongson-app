<?php
  include_once('vendor_header.php');
  include_once('_vendor_login.inc');
?>

<div class="login-form">
  <div class="panel panel-primary">
    <div class="panel-heading"> 
      <h3>登录应用公社</h3>
    </div>

    <div class="panel-body">
      <p class="text-warning"> <?= get_login_message() ?> </p>

      <form id="vendor_loginform" name="vendor_loginform" method="post" action="vendorDoLogin.php"  >
        <input type="password" style="position: fixed; top: -999px "/>

        <div class="form-group">
          <label>用户名</label> 
          <input id="loginname" name="loginname" type="text" class="form-control" autocomplete="off" />
        </div>

        <div class="form-group">
          <label>密  码</label> 
          <input id="password" name="password" type="password" class="form-control" autocomplete="off" />
        </div>

        <p>
        <button class="btn btn-primary" id="loginsubmit"  name="loginsubmit"  type="submit">登 录</button>
      </form>
    </div>

    <div class="panel-footer">
    <a href="http://www.w3school.com.cn">忘记密码</a>
    &nbsp; &nbsp;
    <a href="vendor_register.php">注册新开发者</a>
    </div>
  </div>

</div>

<?php
  clear_login_message();
?>

<?php
  include_once('vendor_footer.php');
?>
