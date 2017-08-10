<?php
include_once('_vendor.inc');
 $appid = $_POST['appid'];
 $version = $_POST['version'];
 $os_id = $_POST['os_id'];
 $result = get_installationFile_by_appId_version_osId($appid,$version,$os_id);
echo $result;
?>
