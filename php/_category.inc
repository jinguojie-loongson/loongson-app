<?php

include_once('_db.inc');
include_once('_util.inc');

function get_all_category_with_id() {
  $sql = "select id, name from category ";
  return db_get_two_columns($sql);
}

?>
