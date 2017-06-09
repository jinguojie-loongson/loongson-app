<?php
/*
 * 返回一个应用的Icon图片
 */
include_once('_util.inc');
include_once('_app.inc');

$id = is_empty($_GET['id']) ? $_POST['data'] : $_GET['id'];
app_inc_download_count($id);

echo $id;
exit;
?>
