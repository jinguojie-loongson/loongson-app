<?php
include_once('_vendor_login.inc');
include_once('_util.inc');
include_once('class.smt.php');

	$login_name = $_POST['login_name'];
	$password =md5(trim($_POST['password']));
	$vendor_name=$_POST['vendor_name'];
	$email = $_POST['email'];
	$description = $_POST['description'];

	$regtime = time();

	$stoken = md5($login_name . $password . $regtime);
	$token_exptime = time() + 60 * 60 * 24; //过期时间为24小时后

	$isActive = "0";

	//向数据库插入注册用户
	$result = register_vendor($login_name, $password, $vendor_name, $email, $stoken, $token_exptime, $isActive, $regtime, $description);   	
	echo $result;


    $smtpserver = "stmp.mail.loongson.cn"; //SMTP服务器，如：smtp.163.com 
    $smtpserverport = 25; //SMTP服务器端口，一般为25 
    $smtpusermail = "renyafei@loongson.cn"; //SMTP服务器的用户邮箱，如xxx@163.com 
    $smtpuser = "renyafei@loongson.cn"; //SMTP服务器的用户帐号xxx@163.com 
    $smtppass = "RENYAFEI137"; //SMTP服务器的用户密码 
    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //实例化邮件类 
    $emailtype = "HTML"; //信件类型，文本:text；网页：HTML 
    $smtpemailto = $email; //接收邮件方，本例为注册用户的Email 
    $smtpemailfrom = $smtpusermail; //发送邮件方，如xxx@163.com 
    $emailsubject = "用户帐号激活";//邮件标题 
    //邮件主体内容 
    $emailbody ="亲爱的".$username."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/><a href='http://localhost/app/php/vendor_active.php?verify=".$token."' target='_blank'>http://localhost/app/php/vendor_active.php?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制
到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>--------  敬上
</p>"; 
    //发送邮件 
    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype); 
    if($rs == 1) { 
        $msg = '恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号！';     
    }else{ 
        $msg = $rs;     
    }
?>
