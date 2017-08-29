<?php
/*
 * 返回一个应用的最新版本
 */
include_once('_util.inc');
include_once('_app.inc');

$app_id = $_GET['app_id'];
$os_id = $_GET['os_id'];

$version = get_app_file_version($app_id, $os_id);
echo $version;

exit;
?>
