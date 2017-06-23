<?php
/*
 * 查询用户是否已经存在
 */

include_once('_util.inc');
include_once('_vendor_login.inc');

// $('#reg_form').bootstrapValidator传递进来

foreach ($_POST as $key => $value)
{
  $field_name = $key;
  $fieldcontent = $value;
}

$mylog = $mylog . "${key} => ${value}";

$ishave = doesVendorExistByfieldname($field_name, $fieldcontent);


if (is_empty($ishave)) {
  //echo 0;//数据库内没有数据
  echo '{"valid":true}';
} else {
  //echo 1;  //数据库内有数据
  echo '{"valid":false}';
}

file_put_contents("/new.txt", $mylog);

exit;
?>




