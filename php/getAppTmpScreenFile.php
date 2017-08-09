<?php
/*
 * 返回一个应用tmp目录下的screen图片
 */
include_once('_util.inc');
include_once('_app.inc');
include_once('_config.inc');

$HOT_DIR = $app_data_url . "tmp/";

$id = $_GET['id'];
$index = $_GET['index'];

$file = $HOT_DIR . get_app_screen_file_by_id($id, $index);

if(!file_exist($file))
  $file = black_filename();

header("Content-type: octet/stream");
header("Content-disposition:attachment;filename=".basename($file));
header("Content-Length:".filesize($file));
readfile($file);
exit;
?>
