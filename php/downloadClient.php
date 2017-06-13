<?php
/*
 * 返回一个应用的Icon图片
 */
include_once('_client.inc');

$HOT_DIR = "../client/";

$file = $HOT_DIR . get_client_download_filename();

header("Content-type: octet/stream");
header("Content-disposition:attachment;filename=".basename($file));
header("Content-Length:".filesize($file));
readfile($file);
exit;
?>
