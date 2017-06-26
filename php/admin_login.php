<?php
  include_once('vendor_header.php');
  include_once('_admin.inc');
?>

<div class="login-form">
  <div class="panel panel-primary">
    <div class="panel-heading"> 
      <h3>管理员登录</h3>
    </div>

    <div class="panel-body">
      <p class="text-warning"> <?= get_admin_login_message() ?> </p>

      <form id="vendor_loginform" name="vendor_loginform" method="post" action="adminDoLogin.php"  >
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
    </div>
  </div>

</div>

<?php
  clear_admin_login_message();
?>

<?php
  include_once('vendor_footer.php');
?>
