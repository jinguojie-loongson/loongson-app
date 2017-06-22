<?php
  include_once('header.php');
  include_once('_vendor_login.inc');
?>

<div class="login-form">
  <h3 class="gray">注册开发者</h3>

  <div class="rounded-rect">
    <div class="error_msg"> <?= get_login_message() ?> </div>

    <form id="reg_form" name="reg_form" method="post" action="vendorRegister.php" >
      <div> 登录名: <br> <input id="login_name" name="login_name" class="input-thin" type="text" /> </div>
      <div> 密  码: <br> <input id="password" name="password" class="input-thin" type="password" /> </div>
      <div> 名  称: <br> <input id="vendor_name" name="vendor_name" class="input-thin" type="text" /> </div>
      <div> 邮  箱: <br> <input id="email" name="email" class="input-thin" type="text" /> </div>
      <div> 简  介: <br> <input id="description" name="description" class="input-thin" type="text" /> </div>

      <input class="button installed" id="regbtn"  name="regbtn"  type="submit" value="注  册" />
    </form>

    <a href="vendor_login.php">返回</a>
  </div>

</div>
