<?php
include_once('_util.inc');
include_once('_config.inc');
  @session_start();
  $J = json_decode($_POST['data']);
  $email_test_token = ($J -> mail_set_json -> email_test_token);
  $smtpserver = ($J -> mail_set_json -> smtpserver);
  $smtpserverport = ($J -> mail_set_json -> smtpserverport);
  $smtpusermail = ($J -> mail_set_json -> smtpusermail);
  $smtpuser = ($J -> mail_set_json -> smtpuser);
  $smtppass = ($J -> mail_set_json -> smtppass);
  $mailtype = ($J -> mail_set_json -> mailtype);
  $app_data_url = ($J -> mail_set_json -> app_data_url);

  //邮箱参数配置
  if (!empty($email_test_token)&&($email_test_token == $_SESSION['email_session_token']))
  {
    //更新邮箱参数配置
    update_config('smtpserver' ,$smtpserver);
    update_config('smtpserverport', $smtpserverport);
    update_config('smtpusermail', $smtpusermail);
    update_config('smtpuser', $smtpuser);
    update_config('smtppass', $smtppass);
    update_config('mailtype', $mailtype);
    update_config('app_data_url', $app_data_url);

    echo json_encode(array("ok"));
  }
  else
  {
     echo json_encode(array("error"));
  }


?>
