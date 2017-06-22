<?php
  include_once('header.php');
  include_once('_vendor_login.inc');
?>

<div class="login-form">
  <img src="../images/favicon.png"/>

  <h3 class="gray">登录应用公社</h3>

  <div class="rounded-rect">
      <div class="error_msg"> <?= get_login_message() ?> </div>


    <form id="vendor_loginform" name="vendor_loginform" method="post" action="vendorDoLogin.php"  >
      <div> 用户名: <br> <input id="loginname" name="loginname" class="input-thin" type="text" /> </div>
      <div> 密  码: <br> <input id="password" name="password" class="input-thin" type="password" /> </div>

      <input class="button installed" id="loginsubmit"  name="loginsubmit"  type="submit" value="登 录" />

    </form>

    <a href="http://www.w3school.com.cn">忘记密码</a>
    &nbsp;
    <a href="vendor_register.php">注册新开发者</a>
  </div>

</div>
