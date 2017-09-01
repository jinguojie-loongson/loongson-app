<?php
include_once('_util.inc');
include_once('_config.inc');
  @session_start();
  $J = json_decode($_POST['data']);
  $email_test_token = ($J -> send_email_test_json -> email_test_token);
  $email_receiver = ($J -> send_email_test_json -> email_receiver);
  $email_title = ($J -> send_email_test_json -> email_title);
  $email_body = htmlentities($J -> send_email_test_json -> email_body);

  //发送邮件
  if (!empty($email_test_token)&&($email_test_token == $_SESSION['email_session_token']))
  {
    $ret = send_email($email_receiver, $email_title, $email_body);

    //记录已发送邮件信息
    update_config('email_receiver' ,$email_receiver);
    update_config('email_title', $email_title);
    update_config('email_body', $email_body);
   
    echo json_encode($ret);
  }
  else
  {
    $ret = "error";
    echo json_encode($ret);
  }



?>

