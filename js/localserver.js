/* 处理本机的服务接口 */

/* 系统中的配置文件 */
var LOCAL_SERVER_URL = "http://localhost:8765/shell";

function get_local_service(cmd, func)
{
  console.log("CMD: " + cmd);
  $.ajax({
    url: LOCAL_SERVER_URL,
    type: 'GET',
    async: true,
    data:{
        cmd: cmd,
        root: 1
    },
    //timeout:5000,    //超时时间
    dataType:'json',    //返回的数据格式：json/xml/html/script/jsonp/text
    beforeSend:function(xhr){
        console.log(xhr)
        console.log('发送前')
    },
    success:function(data, textStatus, jqXHR){
        console.log('Success:')
        console.log(data)
        console.log(textStatus)
        console.log(jqXHR)
        func(data[1]);
    },
    error:function(xhr,textStatus){
        console.log('错误')
        console.log(xhr)
        console.log(textStatus)
    },
    complete:function(){
        console.log('结束')
    }
  })
}

/* Chrome APP不支持async:false */
