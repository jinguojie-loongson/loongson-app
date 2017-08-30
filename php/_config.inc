<?php
include_once('_db.inc');

function get_config($name)
{
global $conn;
  return db_get_one_value("select value from config where name='${name}' ");
}


//******************** 配置信息 ********************************
$smtpserver     = get_config("smtpserver");          //SMTP服务器:例如：mail.loongson.cn 、smtp.qq.com
$smtpserverport =  get_config("smtpserverport"); //SMTP服务器端口 25
$smtpusermail   =  get_config("smtpusermail");     //SMTP服务器的用户邮箱
$smtpuser       =  get_config("smtpuser");             //SMTP服务器的用户帐号，注：部分邮箱只需@前面的用户名
$smtppass       =  get_config("smtppass");             //SMTP服务器的用户密码
$mailtype       =  get_config("mailtype");             //"HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
$app_data_url   =  get_config("app_data_url");     // "/opt/data/";
?>
