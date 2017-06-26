<?php

include_once('_db.inc');
include_once('_util.inc');

function get_hot_count()
{
  return db_get_one_value("select count(*) from hot");
}

function get_all_hot_id()
{
global $conn;
  $sql = "select app_id from hot "
       . "  order by id ";

  return db_get_one_column($sql);
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
echo $sql . "<br>";
  return db_exec($sql);
}

function set_hot_banner_file_by_id($id, $name)
{
global $conn;
  $sql = "update hot set banner_file='${name}' "
         . "  where id=${id}";
echo $sql . "<br>";
  return db_exec($sql);
}

function get_hot_banner_html()
{
  $html = "";
  foreach(get_all_hot_id() as $id) {
    $html = $html . "<img src='getHotBanner.php?id=${id}' alt='app.php?id=${id}' width='960' height='400' /> \n";
  }
  return $html;
}

function upload_hot_app_banner($index, $hot_id)
{
  echo "upload_hot_app_banner($index)" . "<br>";
  
  $file_size = $_FILES["hot_img"]['size'][$index];
  $file_name = $_FILES["hot_img"]['name'][$index];
  $tmp_file  = $_FILES["hot_img"]['tmp_name'][$index];

  $HOT_DIR = "../data/hot/";
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
