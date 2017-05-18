<?php

include_once('_db.inc');
include_once('_util.inc');
include_once('_app.inc');

function get_most_rank_app($limit)
{
  /* 按download_count从大到小排序 */
  $sql = "select id from app "
         . " order by download_count desc "
         . " limit ${limit} ";
  return db_get_one_column($sql);
}

function get_most_rank_app_html()
{
  $limit = 100;
  $x = 10;  /* 每行10个应用图标 */

  $i = 0;

  foreach(get_most_rank_app(100) as $id)
  {
    echo get_app_icon_html($id);
  }
}
?>

