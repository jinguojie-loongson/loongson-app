<?php

include_once('_db.inc');
include_once('_util.inc');
include_once('_app.inc');

function get_most_rank_app($category_id, $limit, $status, $except = "")
{
  /* 按download_count从大到小排序 */
  $sql = "select app.id from app, app_file "
       . "  where app.id = app_file.id ";

  if (!is_empty($status))
    $sql = $sql . " and app_file.status = '${status}'  ";
  if (!is_empty($category_id))
    $sql = $sql . " and category_id = ". $category_id;
  if (!is_empty($except))
    $sql = $sql . " and app.id <> ". $except;

  $sql = $sql
         . " order by download_count desc "
         . " limit ${limit} ";
  return db_get_one_column($sql);
}


function get_most_rank_app_html()
{
  $i = 0;
  $html = "";

  foreach(get_most_rank_app("", 100, "published") as $id)
  {
    $html = $html . get_app_card_html($id);
  }

  return $html;
}

function get_most_rank_app_html_by_category($category_id, $limit = "", $except = "")
{
  if (is_empty($limit))
    $limit = 100;

  $i = 0;
  $html = "";

  $apps = get_most_rank_app($category_id, $limit, "published", $except);
  if (is_empty($apps))
    return "这个分类还没有任何应用，再去别的分类看看吧。";

  foreach($apps as $id)
  {
    $html = $html . get_app_card_html($id);
  }
  return $html;
}
?>

