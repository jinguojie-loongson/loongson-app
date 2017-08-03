<?php
/*
 * 新增系统
 */
include_once('_util.inc');
include_once('_os.inc');

$os_json = json_decode($_POST['data']);
$name = $os_json -> os_json -> name;
$description = $os_json -> os_json -> description;
$probe_cmd = $os_json -> os_json -> probe_cmd;

echo add_os($name, $description, $probe_cmd);

exit;
?>
