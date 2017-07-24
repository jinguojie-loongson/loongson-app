<?php
include_once('_db.inc');
include_once('_util.inc');
include_once('_app.inc');

/*
 * 查询出所有开发者id
 */
function get_vendor_all_id()
{
global $conn;

  $sql = "select id from vendor";
  return db_get_one_column($sql);
}

/*
 * 根据vendor_id 查询vendor_name
 */
function get_vendor_name($id)
{
global $conn;

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

/*
 * 根据vendor_id 查询开发者名称
 */
function get_vendor_login_name($vendor_id)
{
global $conn;

  $sql = "select login_name from vendor "
	. " where id = ${vendor_id}";

  return db_get_one_value($sql);
}

/*
 * 根据vendor_id 查询开发者Email
 */
function get_vendor_email($vendor_id)
{
global $conn;

  $sql = "select email from vendor "
        . " where id = ${vendor_id}";

  return db_get_one_value($sql);
}

/*
 * 根据vendor_id 查询开发者注册时间
 */
function get_vendor_regtime($vendor_id)
{
global $conn;

  $sql = "select regtime from vendor "
        . " where id = ${vendor_id}";
  $reg_time = db_get_one_value($sql);
  ini_set("date.timezone","PRC");
  
  if ($reg_time != null && $reg_time != "") {
    $time = date("Y-m-d H:i", $reg_time);
  } else {
    $time = "";
  }
  return $time;
}

/*
 * 根据vendor_id 查询出开发者状态
 */
function get_vendor_isActive($vendor_id)
{
global $conn;

  $sql = "select isActive from vendor "
        . " where id = ${vendor_id}";

  return db_get_one_value($sql);
}

/*
 * 根据vendor_id 和 isActive 修改 isActive
 */
function update_vendor_isActive($vendor_id, $isActive)
{
global $conn;
  
  $sql = "";
  if ($isActive == 1) {
    $sql = "update vendor set isActive = 0 "
	. " where id = ${vendor_id}";
  } else {
    $sql = "update vendor set isActive = 1 "
        . " where id = ${vendor_id}";
  }
  
  return db_exec($sql);
}

/*
*获取vendorId发布的app表里的信息
*/
function get_all_app_by_vendorId($vendor_id) {
global $conn;
  $sql = "select id, name, category_id, description, download_count, icon_file, is_online from app where id in "
        ." (select app.id from app, review "
        . " where app.id = review.app_id and  vendor_id = ${vendor_id} "
        . " order by review.date_time desc)";
  $result = mysql_query($sql);
  $a = array();
  while ($row = mysql_fetch_row($result))
  {
    array_push($a, array("id"=>$row[0],"name"=>$row[1],"category_id"=>$row[2],
			"description"=>$row[3],"download_count"=>$row[4],"icon_file"=>$row[5],"is_online"=>$row[6]));
  }
  return $a;
}
/*
*根据appid获取app_file表的信息
*/
function get_appfile_by_appid($appid) {
global $conn;
  $sql = "select id,version,filename,download_size,status,install_script,uninstall_script from app_file"
	."  where id=${appid}";
  $result = mysql_query($sql);
  $a = array();
  while ($row = mysql_fetch_row($result))
  {
    array_push($a, array("id"=>$row[0], "version"=>$row[1],"filename"=>$row[2],"download_size"=>$row[3],
		         "status"=>$row[4],"install_script"=>$row[5],"uninstall_script"=>$row[6]));
  }
  return $a;
}

function get_all_app_appfile() {
global $conn;
  $sql = "select  app.id,app.name,app.vendor_id,app.category_id,app_file.version ,"
	." app_file.filename,app_file.status,app_file.install_script,app_file.uninstall_script,"
	." app.is_online from app, app_file "
	." where app.id= app_file.id order by download_count desc limit 99999999";
  $result = mysql_query($sql);
  $array = array();
  while ($row = mysql_fetch_row($result))
  {
    array_push($array, array("id"=>$row[0], "name"=>$row[1],"vendorid"=>$row[2],"categoryid"=>$row[3],"version"=>$row[4],
			     "filename"=>$row[5],"status"=>$row[6],"install_script"=>$row[7],"uninstall_script"=>$row[8],"is_online"=>$row[9]));
  }
  return $array;
}

function get_review_by_appId($appId) {
global $conn;
  $sql = "select id,date_time,version,is_admin,comment,status from review  where app_id=${appId} order by date_time desc";
  $result = mysql_query($sql);

  $a = array();
  $html="<table class ='table table-bordered' ><tr><td>时间</td><td>版本</td><td>is-admin</td><td>管理员附言</td><td>状态</td></tr>";

  while ($row = mysql_fetch_row($result))
  {
    $statustext = get_app_status_text($row[5]);
    $html = $html . "  <tr><td> <span class='app-info'>$row[1]</span></td>  \n"
    . "  <td> <span class='app-info'>$row[2]</span> </td> \n"
    . "  <td> <span class='app-info'>$row[3]</span> </td>  \n"
    . "  <td> <span class='app-info'>$row[4]</span> </td> \n"
    . " <td > <span class='app-info' >$statustext</span></td></tr>  \n";
  }
  return $html;
}

?>
