<?php

include_once('_db.inc');
include_once('_util.inc');

function get_app_icon_file_by_id($id)
{
global $conn;
  $sql = "select icon_file from app "
         . "  where id=${id}";
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

function get_app_download_count($id)
{
global $conn;
  $sql = "select download_count from app "
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

function get_app_html($id)
{
  $name = get_app_name($id);
  $vendor = get_app_vendor($id);
  $download_count = get_app_download_count($id);
  $description = get_app_description($id);
  $icon_img = get_app_icon_html($id);

  $html = "<span class='app-text'> \n"
        . "<p class='app-title'> ${name} </p> \n"
        . "<p class='app-info'> ${vendor} </p> \n"
        . "<p class='app-info'>13.6MB | ${download_count}下载</p> \n"
        . "</span>\n";
  $desc = "<span class='app-desc'> ${description} </span> \n";
  return "<div id='${id}'> ${icon_img} ${html} ${desc} </div> \n";
}

?>
