<?php
/*
 * 提交一个应用的评论
 */
include_once('_util.inc');
include_once('_comment.inc');

$id = is_empty($_GET['id']) ? $_POST['data'] : $_GET['id'];
$comment = is_empty($_GET['comment']) ? $_POST['data'] : $_GET['comment'];

insert_app_comment($id, $comment);

// 返回一个HTML，前端更新。
$comment_id = get_app_newest_comment($id);
echo get_app_one_comment_html($comment_id);

exit;
?>

