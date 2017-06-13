<?php
/*
 * 返回一个应用的Icon图片
 */
include_once('_app.inc');

$HOT_DIR = "../data/app/";

$id = $_GET['id'];
$file = $HOT_DIR . get_app_file_by_id($id);

set_time_limit(0);
ini_set('memory_limit', '512M');
header("Content-type: octet/stream");
header("Content-disposition:attachment;filename=".basename($file));
header("Content-Length:".filesize($file));
ob_end_clean();
readfile($file);
exit;
?>
