<?php
/*
 * 返回一个应用的Icon图片
 */
include_once('_util.inc');
include_once('_app.inc');

$HOT_DIR = "../data/screen/";

$id = $_GET['id'];
$index = $_GET['index'];

$file = $HOT_DIR . get_app_screen_file_by_id($id, $index);

if(!file_exist($file))
  $file = black_filename();

readfile($file);
header("Content-type: octet/stream");
header("Content-disposition:attachment;filename=".basename($file));
header("Content-Length:".filesize($file));
exit;
?>
