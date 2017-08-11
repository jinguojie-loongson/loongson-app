<?php

require_once "Smtp.class.php";

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
  die();
}

/*
 * 参考：
 * http://www.daixiaorui.com/read/16.html
 */
function send_email(
        $smtpemailto,
        $mailtitle,
        $mailcontent)
{
global $smtpserver;
global $smtpserverport;
global $smtpusermail;
global $smtpuser;
global $smtppass;

	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件

        $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);  //这里面的一个true是表示使用身份验证,否则不使用身份验证.
        $smtp->debug = false;  //是否显示发送的调试信息
        $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

        if ($state == "") {
		return "error";
        }

	return "ok";
}

function make_uri($_server, $last_part)
{
        /*
         * 2017/7/5 Jin: $_server['REQUEST_SCHEME'] is not safe in PHP
         *  https://stackoverflow.com/questions/18008135/is-serverrequest-scheme-reliable
         */
        if (is_empty(@$_SERVER['HTTPS'])) {
            $server_request_scheme = 'http';
        } else {
            $server_request_scheme = 'https';
        }

        $uri = $_server['REQUEST_URI'];

        $last = strrpos($uri, "/");
       
	$url = $server_request_scheme
             . "://"
             . $_server['SERVER_NAME']
             . ":"
             . $_server['SERVER_PORT']
             . substr($uri, 0, $last)
             . "/"
             . $last_part;

	return $url;
}

/*
 *随机生成Token值
 */
function getrandcode(){
    $str =array(1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h');
    $res='';
    for($i=0;$i<4;$i++){
        $rand=mt_rand(1,16);
        $res .=$str[$rand];
    }
    return  $res;
  }

/*
 *创建Token
 */
function create_new_token($token_name)
{
  @session_start();

  $token=md5(getrandcode());
  $_SESSION["$token_name"] = $token;
 
  return $token;
}
/*
 *清除session中的Token
 */
function clear_token($token_name)
{
  unset($_SESSION["$token_name"]);
}

?>
