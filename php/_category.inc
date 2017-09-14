<?php
include_once('_db.inc');
include_once('_util.inc');

/*
 *根据类别id获取类别名称
 */
function get_category_name($id)
{
  $sql = "select name from category "
       . "   where id=${id} ";
  return db_get_one_value($sql);
}

/*
 *获取当前所有类别（包含id，类别名称）
 */

function get_all_category_with_id()
{
  $sql = "select id, name from category ";
  return db_get_two_columns($sql);
}

/*
 *获取当前所有类别的id
 */

function get_category_all_id()
{
  $sql = "select id  from category ";
  return db_get_one_column($sql);
}

/*
 *检验当前类别下是否仍有应用，如果存在，则类别不允许删除;
 */

function get_app_count_in_category($id)
{
  $sql = "select count(*) from app"
       . " where category_id = ${id} ";
  return db_get_one_value($sql);
}

function get_category_isActive($id)
{
  return get_app_count_in_category($id) > 0;
}

/*
 * 获取分类管理页面数据
 */
function get_category_list()
{
  $html = "";
  $category_array = get_category_all_id();

  foreach ($category_array as $category_id)
  {
    $html = $html . get_category_one_html($category_id);
  }
  return $html;
}

/*
 * 组装 分类管理页面 列表 html
 */
function get_category_one_html($category_id)
{ 
  $category_name = htmlspecialchars(get_category_name($category_id));
  $isActive = get_category_isActive($category_id);
  $app_num = get_app_count_in_category($category_id);

  $class = "";
  $button_name = "";

  if ($isActive)
  {
    $class = "btn-default disabled";
    $item = "<span class='btn-sm'>该类别下有${app_num}个应用存在，不可删除</span>";
  } 
  else 
  { 
    $class = "btn-primary";
    $button_name = "删 除";
    $item = "<button type='button' id= '${category_id}' name ='$isActive' class='btn ${class} Category_del'>${button_name}</button>";
  }

  $html = "<tr id = '${category_id}'> \n"
        . " <td>${category_id}</td> \n"
        . " <td>${category_name}</td> \n"
        . " <td id='button_$category_id'> ${item} </td> \n"
        . "</tr> \n";
  return $html;
}

/*
 *删除当前类别
 */
function delete_category($category_id)
{
  if (! get_category_isActive($category_id))
  {
    $sql = " delete from category "
         . " where id = ${category_id} ";
    db_exec($sql);
  }
  else
  {
    $result = "该类别下有应用存在，不可删除";
  }

  return $result;
}

/*
 *增加新类别
 */
function add_category($category_name)
{
  $sql = "insert into category(name) values('${category_name}') ";
  db_exec($sql);
  return mysql_insert_id();
}

?>
