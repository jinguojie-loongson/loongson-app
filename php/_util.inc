<?php
/*
 * 显示严重错误信息，停止执行
 */
function fatal_error($msg)
{
  echo "严重错误：<br> $msg";
  die();
}

function is_empty($s)
{
  if (is_array($s))
    return count($s) == 0;
  else
    return $s == null || strlen($s) == 0;
}

$NOPIC = "../images/nopic.png";

function file_exist($file)
{
  return is_file($file);
}

function black_filename()
{
global $NOPIC;
  return $NOPIC;
}
?>
