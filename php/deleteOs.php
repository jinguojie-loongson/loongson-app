<?php
include_once('_util.inc');
include_once('_os.inc');

$os_id = is_empty($_GET['os_id']) ? $_POST['data'] : $_GET['os_id'];

$state = submit_delete_os_event($os_id);
echo $state;

exit;
?>
