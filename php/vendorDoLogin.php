<?php 
include_once('_vendor_login.inc');
include_once('_util.inc');

	session_start();

	$loginname = $_POST['loginname'];
	$password = $_POST['password'];

	if (is_empty($loginname)) {
		clear_current_vendor();
		set_login_message("用户名不得为空！");

 		request_forward("vendor_login.php");
	}

	if (is_empty($password)) {
		clear_current_vendor();
		set_login_message("密码不得为空！");

 		request_forward("vendor_login.php");
	}

	$vendor_id = get_vendor_id_by_loginname($loginname, $password);

	if (is_empty($vendor_id)) {
		clear_current_vendor();
		set_login_message("用户名或密码错误！");

 		request_forward("vendor_login.php");
	} else {
		set_current_vendor($vendor_id);
		clear_login_message();

 		request_forward("vendorWorkbench.php");
	}
?>
