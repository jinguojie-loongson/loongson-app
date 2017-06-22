<?php
  include_once('header.php');
  include_once('_vendor_login.inc');


  clear_current_vendor();
?>

<div class="login-form">
  <img src="../images/favicon.png"/>

  <br>
  <div class="rounded-rect">
    <h3 class="gray">已成功注销</h3>
    5秒钟后自动跳转到登录页面...
    <p>

    <a href="vendor_login.php">重新登录</a>
  </div>

</div>

<?php
  include_once('vendor_footer.php');
?>
