<?php
include_once('_util.inc');
include_once('_category.inc');


$category_name = is_empty($_GET['category_name']) ? $_POST['data'] : $_GET['category_name'];
$result = add_category($category_name);
echo $result;
?>
