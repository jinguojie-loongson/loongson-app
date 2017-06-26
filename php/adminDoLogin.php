<?php 
include_once('_admin.inc');
include_once('_util.inc');

	@session_start();

	$loginname = $_POST['loginname'];
	$password = $_POST['password'];

	if (is_empty($loginname)) {
		clear_current_admin();
		set_admin_login_message("用户名不得为空！");

 		request_forward("admin_login.php");
	}

	if (is_empty($password)) {
		clear_current_admin();
		set_admin_login_message("密码不得为空！");

 		request_forward("admin_login.php");
	}

	$admin_id = get_admin_id_by_loginname($loginname, $password);

	if (is_empty($admin_id)) {
		clear_current_admin();
		set_admin_login_message("用户名或密码错误！");

 		request_forward("admin_login.php");
	} else {
		set_current_admin($admin_id);
		clear_admin_login_message();

 		request_forward("adminWorkbench.php");
	}
?>
