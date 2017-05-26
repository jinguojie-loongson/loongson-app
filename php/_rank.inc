<?php

include_once('_db.inc');
include_once('_util.inc');
include_once('_app.inc');

function get_most_rank_app($category_id, $limit)
{
  /* 按download_count从大到小排序 */
  $sql = "select id from app ";
  if (!is_empty($category_id))
    $sql = $sql . " where category_id = ". $category_id;

  $sql = $sql
         . " order by download_count desc "
         . " limit ${limit} ";
  return db_get_one_column($sql);
}


function get_most_rank_app_html()
{
  $i = 0;
  $html = "";

  foreach(get_most_rank_app("", 100) as $id)
  {
    $html = $html . get_app_html($id);
  }

  return $html;
}

function get_most_rank_app_html_by_category($category_id)
{
  $limit = 100;

  $i = 0;
  $html = "";

  $category = get_most_rank_app($category_id, 100);
  if (is_empty($category))
    return "这个分类还没有任何应用，再去别的分类看看吧。";

  foreach($category as $id)
  {
    $html = $html . get_app_html($id);
  }
  return $html;
}
?>

