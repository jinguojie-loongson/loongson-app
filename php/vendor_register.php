<?php
  include_once('vendor_header.php');
  include_once('_vendor_login.inc');
?>

<div class="login-form" id="register-form">
  <div class="panel panel-primary">
    <div class="panel-heading"> 
      <h3>注册开发者</h3>
    </div>

    <div class="panel-body">
      <form id="reg_form" name="reg_form" method="post" action="vendorRegister.php" >
        <input type="password" style="position: fixed; top: -999px "/>

        <div class="form-group">
          <label>登录名</label> 
          <input id="login_name" name="login_name" type="text" class="form-control" autocomplete="off" />
        </div>

        <div class="form-group">
          <label>密码</label> 
          <input id="password" name="password" type="password" class="form-control" autocomplete="off" />
        </div>

        <div class="form-group">
          <label>电子邮件</label> 
          <input id="email" name="email" type="text" class="form-control" autocomplete="off" />
        </div>

        <div class="form-group">
          <label>个人/机构名称</label> 
          <input id="vendor_name" name="vendor_name" type="text" class="form-control" autocomplete="off" />
        </div>

        <div class="form-group">
          <label>简介</label> 
          <input id="description" name="description" type="text" class="form-control" autocomplete="off" />
        </div>

        <button class="btn btn-primary" id="regbtn"  name="regbtn"  type="submit">注  册</button>
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
