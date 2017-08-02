<?php
/*
 * 校验系统名称是否重复
 */
include_once('_util.inc');
include_once('_os.inc');

$os_id = is_empty($_GET['id']) ? $_POST['data'] : $_GET['id'];
$name = is_empty($_GET['name']) ? $_POST['data'] : $_GET['name'];
$type = is_empty($_GET['type']) ? $_POST['data'] : $_GET['type'];

if ($type == 1) {
  echo check_os_name($name);
} else {
  echo update_check_os_name($os_id, $name);
}
exit;
?>
