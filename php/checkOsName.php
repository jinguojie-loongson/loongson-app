<?php
/*
 * 校验系统名称是否重复
 */
include_once('_util.inc');
include_once('_os.inc');

$os_id = is_empty($_GET['id']) ? $_POST['data'] : $_GET['id'];
$type = is_empty($_GET['type']) ? $_POST['data'] : $_GET['type'];

$json = json_decode($_POST['data']);
$name = $json -> os_json -> name;

if ($type == "add_query") {
  echo check_os_name($name);
} else {
  echo update_check_os_name($os_id, $name);
}
exit;
?>
