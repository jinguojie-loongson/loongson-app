<?php
/*
 * 显示严重错误信息，停止执行
 */
function fatal_error($msg)
{
  echo "严重错误：<br> $msg";
  die();
}

?>
