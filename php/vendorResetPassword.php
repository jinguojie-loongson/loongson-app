<?php
  include_once('vendor_header.php');
include_once('_db.inc');
	include_once('_vendor_login.inc');
	include_once('_util.inc');
	$verify = stripslashes(trim($_GET['verify']));
        $token =$verify;

	$nowtime = time();
	$tokenexptime = getvendor_tokenexptime_by_token($verify);
	$vendorId  = getvendorId_by_token($verify);
	if($nowtime > $tokenexptime){ //$row_vendor[0][1]  
	 echo "<div class='login-form' id='register-form'>  <div class='panel panel-primary'>";
         echo "<div class='panel-heading'> <h3>密码修改</h3>   </div>";
         echo "<div class='panel-body'>";
	 echo "<div class='form-group'><label>您修改密码的有效期已过，请重新发送修改密码的邮件。</label></div> ";
	 echo "</div>";
	 echo "<div class='panel-footer'><a href='vendor_login.php'>返回登录</a></div>";
         die();	
	}




?>

<div class="login-form" id="updatepassword-form">
  <div class="panel panel-primary">
    <div class="panel-heading"> 
      <h3>修改密码</h3>
    </div>
    <div class="panel-body">
      <form id="updatepwd_form" name="updatepwd_form" method="post" action="updatePassword.php" >
	<input type="hidden" id="token" name ="token" value="<?= $token ?>">

        <div class="form-group">
          <label>新密码:</label> 
          <input id="newpassword" name="newpassword" type="password" class="form-control" autocomplete="off" />
        </div>
	
	<div class="form-group">
          <label>确认新密码:</label> 
          <input id="pwdagain" name="pwdagain" type="password" class="form-control" autocomplete="off" />
        </div>

        <button class="btn btn-primary" id="updatepwdbtn"  name="updatepwdbtn"  type="submit">确定</button>
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
