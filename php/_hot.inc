<?php

include_once('_db.inc');
include_once('_util.inc');
include_once('global.inc');

function get_hot_count()
{
  return db_get_one_value("select count(*) from hot");
}

function get_all_hot_id_slogan()
{
global $conn;
  $sql = "select app_id, slogan from hot "
       . "  order by id ";

  return db_get_two_columns($sql);
}

function get_hot_banner_file_by_id($id)
{
global $conn;
  $sql = "select banner_file from hot "
         . "  where app_id=${id}";
  return db_get_one_value($sql);
}

function set_hot_app_id($index, $hot_id)
{
global $conn;
  $sql = "update hot set app_id=${hot_id} "
         . "  where id=${index}";
  return db_exec($sql);
}

function set_hot_slogan($index, $hot_slogan)
{
global $conn;
  $sql = "update hot set slogan='${hot_slogan}' "
	. " where id=${index}";
  return db_exec($sql);
}

function set_hot_banner_file_by_id($id, $name)
{
global $conn;
  $sql = "update hot set banner_file='${name}' "
         . "  where id=${id}";
  return db_exec($sql);
}

function get_hot_banner_html()
{
  $html = "";
  foreach(get_all_hot_id_slogan() as $id_slogan) {
    $html = $html . "<div id='${id_slogan[0]}' style='display: inline-block; width: 300px; padding: 20px; vertical-align: top'> \n"
	. "<img src='getHotBanner.php?id=${id_slogan[0]}' class='hot-img'/> \n"
	. "<p class='hot-p'>${id_slogan[1]}</p> \n"
	. "<input type='hidden' id='hot_app_version' value=''> \n"
	. "</div>";
  }
  return $html;
}

function upload_hot_app_banner($index, $hot_id)
{
global $app_data_url;
  $file_size = $_FILES["hot_img"]['size'][$index];
  $file_name = $_FILES["hot_img"]['name'][$index];
  $tmp_file  = $_FILES["hot_img"]['tmp_name'][$index];

  $HOT_DIR = $app_data_url . "hot/";
  $FILE = $hot_id . ".png";

  if(is_uploaded_file($tmp_file)) {  
    $user_path = $HOT_DIR . $FILE;
    if (move_uploaded_file($tmp_file, $user_path)) {
      set_hot_banner_file_by_id($index, $FILE);
      return 1;
    } else {  
      return 0;
    }  
  }
}

?>
