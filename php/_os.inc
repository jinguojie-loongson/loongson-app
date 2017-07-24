<?php

include_once('_db.inc');
include_once('_util.inc');

function get_os_name($id)
{
  $sql = "select name from os "
       . " where id=${id}";
  return db_get_one_value($sql);
}

function get_all_os_with_id()
{
  $sql = "select id, name from os";
  return db_get_two_columns($sql);
}

?>
