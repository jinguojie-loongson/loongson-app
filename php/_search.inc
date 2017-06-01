<?php

/* 
 * 搜索含有指定字段的应用
 * $search可能含有空格，所以要搜索多个字段
 */
function get_search_app($search)
{
  $sql = "select id from app where ";
  $condition = "";

  $keywords = explode(" ", $search); /* 关键字列表 */
  $search_fields = ["name", "vendor", "category_id", "description", "longdesc"];

  foreach ($keywords as $key)
  {
    foreach ($search_fields as $field)
    {
      if (!is_empty($condition))
        $condition .= " or ";
      $condition .= " ${field} like '%${key}%' ";
    }
  }

  $sql = $sql . $condition
         . " order by download_count desc ";
  return db_get_one_column($sql);
}

function get_search_app_html($search)
{
  $html = "";

  foreach(get_search_app($search) as $id)
  {
    $html = $html . get_app_card_html($id);
  }

  return $html;
}
?>
