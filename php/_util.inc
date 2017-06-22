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

/*
 * 获取浏览器端的用户IP
 */
function get_browser_ip()
{
global $_SERVER;

  $ip = false;

  if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
    $ip = $_SERVER["HTTP_CLIENT_IP"];
  }

  if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
    if ($ip)
    {
      array_unshift($ips, $ip);
      $ip = FALSE;
    }

    for ($i = 0; $i < count($ips); $i++) {
      if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])) {
        $ip = $ips[$i];
        break;
      }
    }
  }
  return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}


function request_forward($url)
{
  header("Location: ${url} "); 
}

?>
