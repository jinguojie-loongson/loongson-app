<?php
include_once('_util.inc');
include_once('_vendor_login.inc');

$email = $_POST['email_forfind'];
//echo $email;
$ishave =doesEmailExist($email);
if (is_empty($ishave)) {
  //echo 0;//数据库内没有数据
  echo '{"valid":false}';
} else {
  //echo 1;  //数据库内有数据
  echo '{"valid":true}';
}
//file_put_contents("/new.txt", $mylog);
//exit;
?>


