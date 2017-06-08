<?php

include_once('_db.inc');
include_once('_util.inc');

function app_version_compare($local_version, $server_version)
{
  $lv = explode(".", $local_version);
  $sv = explode(".", $server_version);

  $i = 0;
  while ($i < count($lv) && $i < count($sv))
  {
    if (intval($lv[$i]) < intval($sv[$i]))
      return -1;
    if (intval($lv[$i]) > intval($sv[$i]))
      return 1;
    $i++;
  }

  if ($i < count($lv))
    return 1;
  if ($i < count($sv))
    return -1;

  return 0;
}

function get_app_icon_file_by_id($id)
{
global $conn;
  $sql = "select icon_file from app "
         . "  where id=${id}";
  return db_get_one_value($sql);
}

function get_app_screen_file_by_id($id, $index)
{
  return $id . "_" . $index . ".png";
}

function get_app_file_by_id($id)
{
global $conn;
  $version = get_app_version($id);

  $sql = "select filename from app_file "
         . "  where id=${id} and version='${version}' ";
  return db_get_one_value($sql);
}

function get_app_md5_by_id($id)
{
global $conn;
  $version = get_app_version($id);

  $sql = "select md5 from app_file "
         . "  where id=${id} and version='${version}' ";
  return db_get_one_value($sql);
}


function get_app_install_script_by_id($id)
{
global $conn;
  $version = get_app_version($id);

  $sql = "select install_script from app_file "
         . "  where id=${id} and version='${version}' ";
  return db_get_one_value($sql);
}

function get_app_icon_html($id)
{
  return  "<img id='${id}' src='getAppIcon.php?id=${id}'  width='64' height='64' alt='' border='0' /> \n";
}

function get_app_name($id)
{
global $conn;
  $sql = "select name from app "
         . "  where id=${id}";
  return db_get_one_value($sql);
}

function get_app_vendor($id)
{
global $conn;
  $sql = "select vendor from app "
         . "  where id=${id}";
  return db_get_one_value($sql);
}

function get_app_category_id($id)
{
global $conn;
  $sql = "select category_id from app "
         . "  where id=${id}";
  return db_get_one_value($sql);
}


function get_app_version($id)
{
global $conn;
  $sql = "select version from app "
         . "  where id=${id}";
  return db_get_one_value($sql);
}

function get_app_download_size($id)
{
global $conn;
  $sql = "select download_size from app "
         . "  where id=${id}";
  return db_get_one_value($sql);
}

function get_app_description($id)
{
global $conn;
  $sql = "select description from app "
         . "  where id=${id}";
  return db_get_one_value($sql);
}

function get_app_longdesc($id)
{
global $conn;
  $sql = "select longdesc from app "
         . "  where id=${id}";
  return db_get_one_value($sql);
}

function get_app_download_count($id)
{
global $conn;
  $sql = "select download_count from app "
         . "  where id=${id}";
  return db_get_one_value($sql);
}

function get_app_screen_file_count($id)
{
global $conn;
  $sql = "select screen_file_count from app "
         . "  where id=${id}";
  return db_get_one_value($sql);
}

function get_app_card_html($id, $status = "not-defined")
{
  $name = get_app_name($id);
  $version = get_app_version($id);
  $vendor = get_app_vendor($id);
  $download_size = get_app_download_size($id);
  $download_count = get_app_download_count($id);
  $description = get_app_description($id);
  $icon_img = get_app_icon_html($id);
  $status_html = "";

  $status_html = get_app_status_icon_html($id, $status);

  $html = "<span class='app-text'> \n"
        . "<p class='app-title'> ${name} </p> \n"
        . "<p class='app-info'> ${vendor} </p> \n"
        . "<p class='app-info'>${download_size} | ${download_count}下载</p> \n"
        . "</span>\n"
        . "<input type='hidden' id='app_version' value='${version}'> \n";
  $desc = "<span class='app-desc'> ${description} </span> \n";
  return "<div id='${id}'> ${icon_img} ${html} ${desc} ${status_html} </div> \n";
}

/*
 * 界面展示
 */

function get_app_screen_file_html($id)
{
  $html = "";

  $count = get_app_screen_file_count($id);
  if ($count == 0)
    return "没有提交界面展示图片";

  for ($i = 0; $i < $count; $i++)
  {
    $img = "<img class='screen-file' id='${id}' src='getAppScreenFile.php?id=${id}&index=${i}'  alt=''/> \n";
    $html = $html . $img;
  }
  return $html;
}

/*
 * 需要升级：在卡片上显示红点
 */

/* 
 * 在应用卡片的右上角显示状态图标
 * 8种状态：
 *   "not-installed" - 未安装，
 *   "installed" 已安装，且最新
 *   "need-updated": 已安装，有升级版本
 *   "downloading": 下载中
 *   "checking-download-file": 检查下载文件
 *   "checking-download-file-error": 检查下载文件错误
 *   "installing": 安装中
 *   "install-error": 安装错误
 */

function app_get_status_short_text($status)
{
  switch($status)
  {
    case "not-installed": return "未安装";
    case "installed": return "已安装";
    case "need-updated": return "有升级";
    case "downloading": return "下载中";
    case "checking-download-file": return "检查中";
    case "checking-download-file-error": return "下载错误";
    case "installing": return "安装中";
    case "install-error": return "安装错误";
  }
  return "错误状态";
}

function get_app_status_icon_html($id, $status)
{
  $text = app_get_status_short_text($status);

  return "<span id='app-icon' class='${status}'>${text}</span>";
}
?>
