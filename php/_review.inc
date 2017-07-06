<?php

include_once('_db.inc');
include_once('_util.inc');

function insert_review($app_id, $version, $is_admin, $operator, $status, $comment)
{
global $conn;
  $sql = "insert into review (app_id, version, is_admin, operator, status, comment, date_time) "
        . "values (${app_id}, '${version}', ${is_admin}, ${operator}, '${status}', '${comment}', now())";

  db_exec($sql);
}

?>
