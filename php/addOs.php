<?php
/*
 * 新增系统
 */
include_once('_util.inc');
include_once('_os.inc');

$name = is_empty($_GET['name']) ? $_POST['data'] : $_GET['name'];
$description = is_empty($_GET['description']) ? $_POST['data'] : $_GET['description'];
$probe_cmd = is_empty($_GET['probe_cmd']) ? $_POST['data'] : $_GET['probe_cmd'];

echo add_os($name, $description, $probe_cmd);
exit;

?>
