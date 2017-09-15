<?php
include_once('_db.inc');
include_once('_util.inc');
include_once('_app.inc');
include_once('_os.inc');

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
  $sql = "select app_file.id,app_file.version,app_file.filename,app_file.download_size,app_file.status,app_file.install_script,app_file.uninstall_script,os.name,app_file.os_id "
	." from app_file, os "
	."  where app_file.os_id = os.id and app_file.id=${appid}";
  $result = mysql_query($sql);
  $a = array();
  while ($row = mysql_fetch_row($result))
  {
    array_push($a, array("id"=>$row[0], "version"=>$row[1],"filename"=>$row[2],"download_size"=>$row[3],
		         "status"=>$row[4],"install_script"=>$row[5],"uninstall_script"=>$row[6],"os_name"=>$row[7],"os_id"=>$row[8]));
  }
  return $a;
}

function get_all_app_appfile() {
global $conn;
  $sql = "select  app.id,app.name,app.vendor_id,app.category_id,app_file.version ,"
	." app_file.filename,app_file.status,app_file.install_script,app_file.uninstall_script,"
	." app.is_online,app_file.os_id from app, app_file "
	." where app.id= app_file.id order by download_count desc limit 99999999";
  $result = mysql_query($sql);
  $array = array();
  while ($row = mysql_fetch_row($result))
  {
    array_push($array, array("id"=>$row[0], "name"=>$row[1],"vendorid"=>$row[2],"categoryid"=>$row[3],"version"=>$row[4],
			     "filename"=>$row[5],"status"=>$row[6],"install_script"=>$row[7],"uninstall_script"=>$row[8],
			     "is_online"=>$row[9],"os_id"=>$row[10]));
  }
  return $array;
}

function get_review_by_appId($appId) {
global $conn;
  $sql = "select id,date_time,version,is_admin,comment,status,operator  from review  where app_id=${appId} order by date_time desc";
  $result = mysql_query($sql);

  $a = array();
  $html="<table class ='table table-bordered' ><tr><td>时间</td><td>版本</td><td>操作者</td><td>管理员附言</td><td>状态</td></tr>";
  while ($row = mysql_fetch_row($result))
  {
    $statustext = get_app_status_text($row[5]);
    $isadmin = $row[3];
    if($row[3] == 1 ){
      $isadmin = "管理员";
    }else{
      $isadmin =  get_vendor_name($row[6]);
    }
    $html = $html . "  <tr><td> <span class='app-info'>$row[1]</span></td>  \n"
    . "  <td> <span class='app-info'>$row[2]</span> </td> \n"
    . "  <td> <span class='app-info'>$isadmin</span> </td>  \n"
    . "  <td> <span class='app-info'>$row[4]</span> </td> \n"
    . " <td > <span class='app-info' >$statustext</span></td></tr>  \n";
  }
  return $html;
}

function get_installationFileHTML_by_appId_version_osId($appId,$version,$os_id){
global $conn;
  $sql = "select id,version,os_id,filename,install_script,uninstall_script from app_file "
          ."where id=${appId}  and version='${version}' and os_id=${os_id}";
  $result = mysql_query($sql);

  $a = array();
  $html="<table class ='table table-bordered' >";
  while ($row = mysql_fetch_row($result))
  {
    $os_name = get_os_name($row[2]);
    $html = $html . "  <tr><td>操作系统名称</td>  \n"
    . "  <td> <span class='app-info'>" . $os_name ." </td> </tr> "
    . "  <tr> <td> <span class='app-info'>文件名</span> </td>  \n"
    . "  <td> <span class='app-info'> <a href='downloadFile.php?id=$row[0]&version=$row[1]&os_id=$row[2]'>$row[3]</a></span> "
    . "  </td> </tr>"
    . "  <tr>  <td > <span class='app-info' >安装命令</span></td>  \n"
    . "  <td > <span class='app-info' >$row[4]</span></td></tr>  \n"
    . "  <tr>  <td > <span class='app-info' >卸载命令</span></td>  \n"
    . "  <td > <span class='app-info' >$row[5]</span></td></tr>  \n";
  }
  return $html;
}
?>
