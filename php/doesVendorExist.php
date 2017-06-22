<?php
/*
 * 查询用户是否已经存在
 */

include_once('_util.inc');
include_once('_vendor_login.inc');

$field_name = is_empty($_GET['field_name']) ? $_POST['data'] : $_GET['field_name'];
$fieldcontent = is_empty($_GET['fieldcontent']) ? $_POST['data'] : $_GET['fieldcontent'];

$ishave = doesVendorExistByfieldname($field_name, $fieldcontent);

if (is_empty($ishave)) {
  echo 0;//数据库内没有数据
} else {
  echo 1;  //数据库内有数据
}

exit;
?>




