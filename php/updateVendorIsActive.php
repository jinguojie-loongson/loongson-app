<?php

/*
 * 修改开发者帐号状态
 */
include_once('_util.inc');
include_once('_app.inc');

@session_start();

$vendor_id = is_empty($_GET['vendor_id']) ? $_POST['data'] : $_GET['vendor_id'];
$isActive = is_empty($_GET['isActive']) ? $_POST['data'] : $_GET['isActive'];

$state = modify_vendor_isActive($vendor_id, $isActive);

echo $state;
?>
