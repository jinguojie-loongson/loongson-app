<?php
  include_once('vendor_header.php');
  include_once('_vendor_login.inc');


  clear_current_vendor();
?>

<div class="login-form">
  <div class="panel panel-primary">
    <div class="panel-heading"> 
      <h3>已成功注销</h3>
    </div>

    <div class="panel-body">
      5秒钟后自动跳转到登录页面...
    </div>

    <div class="panel-footer">
      <a href="vendor_login.php">重新登录</a>
    </div>
  </div>
</div>


<?php
  include_once('vendor_footer.php');
?>
