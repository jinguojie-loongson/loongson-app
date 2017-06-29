<?php

/* 
 * 搜索含有指定字段的应用
 * $search可能含有空格，所以要搜索多个字段
 */
function get_search_app($search)
{
  $sql = "select app.id from app, vendor, category "
       . "   where app.category_id = category.id "
       . "     and app.vendor_id = vendor.id "
       . "     and ( ";
  $condition = "";

  $keywords = explode(" ", $search); /* 关键字列表 */
  $search_fields = array("app.name", "vendor.vendor_name", "vendor.description", "category.name", "app.description", "app.longdesc");

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
         . " ) "
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

  return is_empty($html) ? "没有找到符合的应用。" : $html;
}
?>
