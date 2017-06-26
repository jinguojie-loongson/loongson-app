<?php
/*
 * 返回一个应用的Icon图片
 */
include_once('_util.inc');
include_once('_app.inc');
include_once('_comment.inc');

print_r($_GET);
$id = is_empty($_GET['id']) ? $_POST['data'] : $_GET['id'];
$audit = is_empty($_GET['audit']) ? $_POST['data'] : $_GET['audit'];

if ($audit == "0" || $audit == "1")
  audit_comment($id, $audit);
else
  audit_comment_del($id);

echo $id;
exit;
?>
