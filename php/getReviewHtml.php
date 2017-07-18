<?php
include_once('_vendor.inc');
 $appid = $_POST['appid'];
 $result = get_review_by_appId($appid);
echo $result;
?>
