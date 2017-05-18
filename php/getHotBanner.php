<?php
/*
 * 返回一个Hot应用的图片数据
 */
include_once('_hot.inc');

$HOT_DIR = "../data/hot/";

$id = $_GET['id'];
$file = get_hot_banner_file_by_id($id);
readfile($HOT_DIR . $file);
header("Content-type: octet/stream");
header("Content-disposition:attachment;filename=".basename($file));
header("Content-Length:".filesize($file));
exit;
?>
