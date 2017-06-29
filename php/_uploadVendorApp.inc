<?php
include_once('_db.inc');
include_once('_util.inc');

function insert_vendor_app($vendor_id, $icon_file, $name, $category_id, $description, $longdesc, 
	$screen_file_1, $screen_file_2, $screen_file_3, $screen_file_4, $screen_file_5, 
	$file_name, $file_size, $version, $install_script, $uninstall_script)
{
  insert_app_basic_information($vendor_id, $name, $category_id, $description, $longdesc, $version, $file_size);
  
  $app_id = get_app_id($name, $category_id, $version);
  
  $icon_file = icon_cp_rename($app_id, $icon_file);
  $screen_file_count = icon_screen_cp_rename($app_id, $screen_file_1, $screen_file_2, $screen_file_3, $screen_file_4, $screen_file_5);
  file_cp($file_name);
  
  update_app_icon_screen($app_id, $icon_file, $screen_file_count);

  insert_app_file($app_id, $version, $file_name, $file_size, "new", $install_script, $uninstall_script);
  insert_review($app_id, $version, 0, $vendor_id, "new", "");

}

/*
 * 将基本信息（名称、类别、精简、完整、当前版本、文件大小）存入app表
 */
function insert_app_basic_information($vendor_id, $name, $category_id, $description, $longdesc, $version, $file_size)
{
global $conn;
  $sql = "insert into app (name, vendor_id, category_id, description, longdesc, version, download_count) "
	. " values ('${name}', ${vendor_id}, ${category_id}, '${description}', '${longdesc}', '${version}', 0)";
  db_exec($sql);
}

/*
 * 根据 名称 类别id 当前版本 查询出最新插入的app_id
 */
function get_app_id($name, $category_id, $version)
{
global $conn;
  $sql = "select id from app "
	. " where name = '${name}' and category_id = ${category_id} and version = '${version}'";
  
  return db_get_one_value($sql);
}

/*
 * 根据查询出的app_id 将icon图片 移动位置 重命名 并返回新文件名
 */
function icon_cp_rename($app_id, $icon_file)
{
  //$current_url = "/var/www/html/app";
  $icon_target_url = "../data/icon/";
  
  copy($icon_file, $icon_target_url . $app_id . ".png");
 // copy($current_url . substr($icon_file, 2), $icon_target_url . $app_id . ".png");
 // unlink($icon_file);

  return $app_id . ".png";
}

/*
 * 根据查询出的app_id 将screen图片 移动位置 重命名 并返回screen总数
 */
function icon_screen_cp_rename($app_id, $screen_file_1, $screen_file_2, $screen_file_3, $screen_file_4, $screen_file_5)
{
  //$current_url = "/var/www/html/app";
  $screen_target_url = "../data/screen/";
  $screen_sum = 0;  

  if (!is_empty($screen_file_1)) {
    copy($screen_file_1, $screen_target_url . $app_id . "_0.png");
   // unlink($current_url . substr($screen_file_1, 2));
    $screen_sum ++;
  }
  if (!is_empty($screen_file_2)) {
    copy($screen_file_2, $screen_target_url . $app_id . "_0.png");
   // unlink($current_url . substr($screen_file_2, 2));
    $screen_sum ++;
  }
  if (!is_empty($screen_file_3)) {
    copy($screen_file_3, $screen_target_url . $app_id . "_0.png");
   // unlink($current_url . substr($screen_file_3, 2));
    $screen_sum ++;
  }
  if (!is_empty($screen_file_4)) {
    copy($screen_file_4, $screen_target_url . $app_id . "_0.png");
   // unlink($current_url . substr($screen_file_4, 2));
    $screen_sum ++;
  }
  if (!is_empty($screen_file_5)) {
    copy($screen_file_2, $screen_target_url . $app_id . "_0.png");
   // unlink($current_url . substr($screen_file_5, 2));
    $screen_sum ++;
  }
  return $screen_sum;
}

/*
 * 将安装文件 移动位置
 */
function file_cp($file_name)
{
  $current_url = "../data/tmp/";
  $file_target_url = "../data/app/";
  
  copy($current_url . $file_name, $file_target_url . $file_name);
  //unlink($current_url . $file_name);
}

/*
 * 更新app表中 icon_file、 screen_file_count 字段
 */
function update_app_icon_screen($app_id, $icon_file, $screen_file_count)
{
global $conn;
  $sql = "update app "
	. " set icon_file = '${icon_file}', screen_file_count = '${screen_file_count}' "
	. " where id = ${app_id}";

  db_exec($sql);
}

/*
 * 插入app_file表
 */
function insert_app_file($app_id, $version, $file_name, $file_size, $status, $install_script, $uninstall_script)
{
global $conn;
  $file_name_md5 = md5($file_name);
  $download_size = round($file_size/1024, 1) . "M";
  $sql = "insert into app_file (id, version, filename, download_size, md5, status, install_script, uninstall_script) "
	. " values (${app_id}, '${version}', '${file_name}', '${download_size}', '${file_name_md5}', '${status}', '${install_script}', '${uninstall_script}')";

  db_exec($sql);
}

/*
 * 插入review表
 */
function insert_review($app_id, $version, $is_admin, $operator, $status, $comment)
{
global $conn;
  $sql = "insert into review (app_id, version, is_admin, operator, status, comment, date_time) "
	. "values (${app_id}, '${version}', ${is_admin}, ${operator}, '${status}', '${comment}', now())";

  db_exec($sql);
}
