<?php
/*
 * 返回一个应用的Icon图片
 */
include_once('_app.inc');
include_once('_rank.inc');
include_once('_my.inc');

/* 前端提交的$app_list_data：
 *   系统目录下，每一个已安装应用的文件名：“ID：版本号”，回车符分割
 *
 * 例如：
 *
 *  1:1.0.015
 *  2:2.3.245.2500
 */
$app_list_data = $_POST['data'];

$html = "";

$ss = explode("\n", $app_list_data);
foreach ($ss as $a)
{
  $p = explode(":", $a);
  $app_id = $p[0];
  $version = $p[1];

  $html = $html . get_app_card_html($app_id);

  /* 如果有升级，则需要显示一个额外的红点 */
  if (app_version_compare($version, get_app_version($app_id)) < 0)
    $html = $html . get_app_update_icon_html($app_id);
}

echo $html;
exit;
?>
