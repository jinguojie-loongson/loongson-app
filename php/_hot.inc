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
  $sql = "select id from hot ";

  return db_get_one_column($sql);
}

function get_hot_banner_file_by_id($id)
{
global $conn;
  $sql = "select banner_file from hot "
         . "  where id=${id}";
  return db_get_one_value($sql);
}

function get_hot_banner_html()
{
  $html = "";
  foreach(get_all_hot_id() as $id) {
    $html = $html . "<img id='${id}' src='getHotBanner.php?id=${id}' longdesc='app.php?id=${id}' width='280' height='300' alt='Picture' /> \n";
  }
  return $html;
}
?>
