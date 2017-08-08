<?php
/*
 * 返回一个应用tmp目录下的Icon图片
 */
include_once('_config.inc');


$HOT_DIR = $file_url . "tmp/";

$file_name = $_GET['file_name'];
$file = $HOT_DIR . $file_name;
header("Content-type: octet/stream");
header("Content-disposition:attachment;filename=".basename($file));
header("Content-Length:".filesize($file));
readfile($file);
exit;
?>

