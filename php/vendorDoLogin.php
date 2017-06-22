<?php 
include_once('_vendor_login.inc');
include_once('_util.inc');

	$loginname = $_POST['loginname'];
	$password = $_POST['password'];

	$vendor_id = get_vendor_id_by_loginname($loginname, $password);
	if (is_empty($vendor_id)) {
		clear_current_vendor();
		set_login_message("登录错误！");

 		request_forward("vendor_login.php");
	} else {
		set_current_vendor($vendor_id);
		clear_login_message("登录错误！");

 		request_forward("vendorWorkbench.php");
	}
?>
