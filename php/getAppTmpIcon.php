<?php
/*
 * 返回一个应用tmp目录下的Icon图片
 */
include_once('_app.inc');
include_once('_config.inc');


$HOT_DIR = $app_data_url . "tmp/";

$id = $_GET['id'];
$file = $HOT_DIR . get_app_icon_file_by_id($id);
header("Content-type: octet/stream");
header("Content-disposition:attachment;filename=".basename($file));
header("Content-Length:".filesize($file));
readfile($file);
exit;
?>
