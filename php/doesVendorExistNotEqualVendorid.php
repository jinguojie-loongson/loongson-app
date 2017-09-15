<?php
include_once('_util.inc');
include_once('_vendor_login.inc');
@session_start();
$vendor_id = get_current_vendor();
foreach ($_POST as $key => $value)
{
  $field_name = $key;
  $fieldcontent = $value;
}
//$mylog = $mylog . "${key} => ${value}"."==vendor_id==".$vendor_id;


$ishave = doesVendorExistNotEqualVendorid($field_name, $fieldcontent,$vendor_id);
if (is_empty($ishave)) {
  echo '{"valid":true}';//数据库内没有数据
} else {
  echo '{"valid":false}';//数据库内有数据
}
//file_put_contents("/new.txt", $mylog);
exit;
?>


