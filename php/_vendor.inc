<?php
include_once('_db.inc');
include_once('_util.inc');
include_once('_app.inc');


/*
 * 根据vendor_id 查询vendor_name
 */
function get_vendor_name($id)
{
  $sql = "select vendor_name from vendor "
	. " where id = ${id}";
  return db_get_one_value($sql);
}


/*
 * 根据vendor_id 查询出符合条件的应用id
 * 按状态变化的时间排序
 */
function get_all_app_id_for_vendor($vendor_id)
{
global $conn;

  $sql = "select app.id from app, review "
	. " where app.id = review.app_id and  vendor_id = ${vendor_id} "
	. " order by review.date_time desc";
 return db_get_one_column($sql);
}


/*
 * 组装单个html
 */
function get_vendor_one_app_html($app_id)
{
  $icon = get_app_icon_file_by_id($app_id);
  $name = get_app_name($app_id);
  $version = get_app_version($app_id);
  $download_size = get_app_download_size($app_id, $version);
  $download_count = get_app_download_count($app_id);
  $category_name = get_category_name(get_app_category_id($app_id));
  $description = get_app_description($app_id);
  
  $html = "<div class='vendor-app-card' id=${app_id}> \n"
	. "  <img src='../data/icon/${icon}' /> \n"
	. "  <span class='app-title'> ${name} </span> <br> \n"
	. "  <span class='app-info'>版本号：${version} </span><br> \n"
	. "  <i class='fa fa-file-o'></i> <span class='app-info'>大小：${download_size}</span>  \n"
	. "  <i class='fa fa-cloud-download'></i> <span class='app-info'>下载量：${download_count}</span>  \n"
	. "  <i class='fa fa-delicious'></i> <span class='app-info'>应用种类：${category_name}</span> <br> <br> \n"
	. "  <span class='app-info'> ${description} </span> \n"
	. "</div> \n";
  return $html;
}

/*
 * 返回页面的html
 */
function get_vendor_all_app_html($vendor_id)
{
  $html = "";
  foreach (get_all_app_id_for_vendor($vendor_id) as $id)
  {
    $html = $html . get_vendor_one_app_html($id);
  }
  return $html;
}

?>
