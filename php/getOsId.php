<?php
/*
 * 返回os表所有记录
 */
include_once('_util.inc');
include_once('_os.inc');

$json = get_os_id_prober_cmd();
echo $json;

exit;
?>

