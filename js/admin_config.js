$(document).ready(function(){
/*常规设置——发送测试邮件 */
  $('#generalSetting_form').bootstrapValidator({
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
