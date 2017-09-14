<?php
include_once('_util.inc');
include_once('_category.inc');

$J=json_decode($_POST['data']);
$category_name=addslashes($J -> category_json -> category_name);

$result = htmlentities(add_category($category_name), ENT_QUOTES, "UTF-8");
echo $result;
?>
