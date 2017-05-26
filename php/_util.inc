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
?>
