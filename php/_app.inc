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
  return  "<img id='${id}' src='getAppIcon.php?id=${id}'  width='80' height='80' alt='' border='0' /> \n";
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

function get_app_card_html($id)
{
  $name = get_app_name($id);
  $vendor = get_app_vendor($id);
  $download_size = get_app_download_size($id);
  $download_count = get_app_download_count($id);
  $description = get_app_description($id);
  $icon_img = get_app_icon_html($id);

  $html = "<span class='app-text'> \n"
        . "<p class='app-title'> ${name} </p> \n"
        . "<p class='app-info'> ${vendor} </p> \n"
        . "<p class='app-info'>${download_size} | ${download_count}下载</p> \n"
        . "</span>\n";
  $desc = "<span class='app-desc'> ${description} </span> \n";
  return "<div id='${id}'> ${icon_img} ${html} ${desc} </div> \n";
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
function get_app_update_icon_html($id)
{
  return "<span class='update-icon' id='${id}'></span>";
}
?>
