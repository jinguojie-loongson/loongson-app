<?php
include_once('_util.inc');
include_once('_vendor_login.inc');

$field_name = is_empty($_GET['field_name']) ? $_POST['data'] : $_GET['field_name'];
$fieldcontent = is_empty($_GET['fieldcontent']) ? $_POST['data'] : $_GET['fieldcontent'];
$vendor_id = is_empty($_GET['vendor_id']) ? $_POST['data'] : $_GET['vendor_id'];


$ishave =doesVendorExistNotEqualVendorid($field_name, $fieldcontent,$vendor_id);
if (is_empty($ishave)) {
  echo 0;//数据库内没有数据
} else {
  echo 1;  //数据库内有数据
}

exit;
?>


