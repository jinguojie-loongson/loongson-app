<?php
/*
 * 客户端工具
 */

function get_client_changelog()
{
  return file_get_contents("../Changelog");
}

function get_client_version()
{
  return str_replace(PHP_EOL, '', file_get_contents("../VERSION"));
}

function get_client_download_filename()
{
  // app-client-1.0.4.sh
  return "app-client-" . get_client_version() . ".sh";
}

?>
