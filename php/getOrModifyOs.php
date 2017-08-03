<?php
/*
 * 根据os_id 查询系统内容 or  更新系统内容
 *    state == 0 查询内容
 *    state == 1 更新内容
 */
include_once('_util.inc');
include_once('_os.inc');

$os_id = is_empty($_GET['os_id']) ? $_POST['data'] : $_GET['os_id'];
$state = is_empty($_GET['state']) ? $_POST['data'] : $_GET['state'];
$os_json = "";
if ($state == "query") {
  $os_json = get_or_modify_os_id($os_id, "", "", "", $state);
} else if ($state == "update") {
  $json = json_decode($_POST['data']);
  $os_name = $json -> os_json -> os_name;
  $os_description = $json -> os_json -> os_description;
  $os_probe_cmd = $json -> os_json -> os_probe_cmd;

  $os_json = get_or_modify_os_id($os_id, $os_name, $os_description, $os_probe_cmd, $state);
}
echo $os_json;

exit;
?>
