$(document).ready(function(){
/*常规设置——参数配置*/
  $('#mail_set_form').bootstrapValidator({
      message: 'This value is not valid',
      feedbackIcons: {
      　valid: 'glyphicon glyphicon-ok',
      　invalid: 'glyphicon glyphicon-remove',
      　validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
        smtpserver: {
          validators: {
            notEmpty: {
              message: 'SMTP服务器不能为空'
            }
          }
        },
        smtpserverport: {
          validators: {
            notEmpty: {
              message: 'SMTP服务器端口不能为空'
            }
          }
        },
        smtpusermail: {
          validators: {
            notEmpty: {
              message: 'SMTP服务器的用户邮箱不能为空'
            },
            emailAddress: {
              message: '邮箱地址格式有误'
            }
          }
        },
        smtpuser: {
          validators: {
            notEmpty: {
              message: 'SMTP服务器的用户帐号不能为空'
            },
            emailAddress: {
              message: '邮箱地址格式有误'
            }
          }
        },
        smtppass: {
          message: 'SMTP服务器的用户密码不能为空',
            validators: {
              notEmpty: {
                message: 'SMTP服务器的用户密码不能为空'
              }
            }
        },
        mailtype: {
          message: '邮件格式（HTML/TXT)不能为空',
            validators: {
              notEmpty: {
                message: '邮件格式（HTML/TXT)不能为空'
              }
            }
        },
        app_data_url: {
          message: 'app_data_url不能为空',
            validators: {
              notEmpty: {
                message: 'app_data_url不能为空'
              }
            }
        }

      }
  });


/*常规设置——发送测试邮件 */
  $('#mail_test_form').bootstrapValidator({
      message: 'This value is not valid',
      feedbackIcons: {
      　valid: 'glyphicon glyphicon-ok',
      　invalid: 'glyphicon glyphicon-remove',
      　validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
        email_receiver: {
          validators: {
            notEmpty: {
              message: '收件人不能为空'
            },
            emailAddress: {
              message: '邮箱地址格式有误'
            }
          }
        },
        email_title: {
          message: '邮件主题不能为空',
            validators: {
              notEmpty: {
                message: '邮件主题不能为空'
              },
              stringLength: {
                min: 1,
                max: 1000,
                message: '长度必须在1到1000位之间'
              }
            }
        },
        email_body: {
          message: '邮件内容检验失败',
          validators: {
          }
        }
      }
  });

/*邮箱参数配置——点击保存按钮，提交信息*/
  $("#mail_set_btn").click(function() {
      debugger
      var email_test_token = $("#email_test_token").val();
      var smtpserver = $("#smtpserver").val();
      var smtpserverport = $("#smtpserverport").val();
      var smtpusermail = $("#smtpusermail").val();
      var smtpuser = $("#smtpuser").val();
      var smtppass = $("#smtppass").val();
      var mailtype = $("#mailtype").val();
      var app_data_url = $("#app_data_url").val();

      var mail_set_json ={
        "mail_set_json":{
                        "email_test_token" : email_test_token,
                        "smtpserver" : smtpserver,
                        "smtpserverport" : smtpserverport,
                        "smtpusermail" : smtpusermail,
                        "smtpuser" : smtpuser,
                        "smtppass" : smtppass,
                        "mailtype" : mailtype,
                        "app_data_url" : app_data_url
                         }
      };

      var obj = JSON.stringify(mail_set_json);

      url = window.location.href;
      n = url.lastIndexOf("/");
      url = url.substr(0, n) + "/setMailParameter.php?";

      get_server_service_json(url, obj, function(data){
        if(data[0] == "ok"){
          success_message("邮箱参数配置保存成功");
        }else{
          fail_message("邮箱参数配置保存失败");
        }
      });
  });

/*邮件发送测试——点击发送按钮，提交信息*/
  $("#mail_test_btn").click(function() {
      var email_test_token = $("#email_test_token").val();
      var email_receiver = $("#email_receiver").val();
      var email_title = $("#email_title").val();
      var email_body = $("#email_body").val();
      var send_email_test_json={
        "send_email_test_json":{
                         "email_test_token" : email_test_token,
                         "email_receiver" : email_receiver,
                         "email_title" : email_title,
                         "email_body" : email_body
                         }
      };

      var obj=JSON.stringify(send_email_test_json);

      url = window.location.href;
      n = url.lastIndexOf("/");
      url = url.substr(0, n) + "/sendMailTest.php?";

      get_server_service_json(url, obj, function(data){
        if(data[1] == "ok"){
          success_message("测试邮件发送成功");
        }else{
          fail_message("测试邮件发送失败");
        }
      });

  });

});
