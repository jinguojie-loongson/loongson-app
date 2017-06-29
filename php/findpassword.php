<?php
include_once('vendor_header.php');
include_once('_vendor_login.inc');
include_once('_util.inc');
	$email = $_POST['email_forfind'];
	$regtime = time();
	$token = md5($email . $regtime);
	$isActive = "0";
	//修改token
	$result = update_token_vendor_by_email($email,$token);   	

	//发送邮件
	$url = make_uri($_SERVER, "vendorResetPassword.php?verify=" . $token);

        $mailtitle = "[龙芯应用公社] 用户修改密码";
        $mailcontent = "尊敬的用户，<br/>"
                     . " <p>请点击链接修改您的密码。</p>"
                     . " <a href='${url}' target='_blank'>${url}</a><br/>"
                     . " 如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问。该链接24小时内有效。<br/>"
                     . " 如果此次激活请求非你本人所发，请忽略本邮件。<br/>"
                     . " <p>-------- 龙芯应用公社 敬上 </p>"; 

        $ret = send_email($email, $mailtitle, $mailcontent);

	echo "<div class='login-form' id='register-form'>  <div class='panel panel-primary'>";
        echo "<div class='panel-heading'> <h3>邮件提示</h3>   </div>";
        echo "<div class='panel-body'>";
        if($ret == "error"){
	        echo "<div class='form-group'><label>对不起，邮件发送失败！请检查邮箱填写是否有误。</label></div> ";
                echo "</div>";
                echo "<div class='panel-footer'><a href='vendor_login.php'>返回登录</a></div>";
                exit();
        }
        echo "<div class='form-group'><label>系统已经发送一封邮件到到您提供的邮箱${email}，请点击链接修改密码。</label></div>";
        echo "</div>";
        echo "<div class='panel-footer'><a href='vendor_login.php'>返回登录</a></div>";
        echo "</div>";
        echo "</div>";
        echo "<?php include_once('vendor_footer.php');?>";
?>
<?php  include_once('vendor_footer.php'); ?>
