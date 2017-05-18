<?php

include_once('_db.inc');
include_once('_util.inc');

function get_all_category() {
  $sql = "select name from category ";
  return db_get_one_column($sql);
}

?>
