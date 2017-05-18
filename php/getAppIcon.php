<?php
/*
 * 返回一个应用的Icon图片
 */
include_once('_app.inc');

$HOT_DIR = "../data/icon/";

$id = $_GET['id'];
$file = get_app_icon_file_by_id($id);
readfile($HOT_DIR . $file);
header("Content-type: octet/stream");
header("Content-disposition:attachment;filename=".basename($file));
header("Content-Length:".filesize($file));
exit;
?>
