<?php
/*
*修改密码
 */

include_once('_util.inc');
include_once('_vendor_login.inc');
$newpassword = md5(trim($_POST['newpassword'])); 
$token = $_POST['token'];
$isupdate = update_password_vendor_by_token($newpassword, $token);
$password = getvendor_password_by_token($token);
request_forward("vendor_success.php");
exit;
?>


