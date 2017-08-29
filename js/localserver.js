/* 处理本机的服务接口 */

/* 系统中的配置文件 */
var LOCAL_SERVER_URL = "http://localhost:8765/shell";

function get_local_service(cmd, func, error_func)
{
  console.log("CMD: " + cmd);
  $.ajax({
    url: LOCAL_SERVER_URL,
    type: 'GET',
    async: true,
    data:{
        cmd: cmd
        //root: 1
    },
    //timeout:5000,    //超时时间
    dataType:'json',    //返回的数据格式：json/xml/html/script/jsonp/text
    success:function(data, textStatus, jqXHR){
        console.log('Success:')
        console.log(data);
        //console.log("textStatus: " + textStatus)
        //console.log(jqXHR)
        func(data[1], data[0]);
    },
    error:function(xhr,textStatus){
        console.log('错误');
        console.log(xhr);
        console.log(textStatus);
        if (error_func)
            error_func(textStatus);
    },
  })
}

function get_local_service_overloading(cmd, func, error_func, obj)
{
  console.log("CMD: " + cmd);
  $.ajax({
    url: LOCAL_SERVER_URL,
    type: 'GET',
    async: true,
    context: obj,
    data:{
        cmd: cmd
        //root: 1
    },
    //timeout:5000,    //超时时间
    dataType:'json',    //返回的数据格式：json/xml/html/script/jsonp/text
    success:function(data, textStatus, jqXHR){
        console.log('Success:')
        console.log(data);
        //console.log("textStatus: " + textStatus)
        //console.log(jqXHR);
        func.call(this, data[1], data[0]);
    },
    error:function(xhr,textStatus){
        console.log('错误');
        console.log(xhr);
        console.log(textStatus);
        if (error_func)
            error_func(textStatus);
    },
  })
}

/* Chrome APP不支持async:false */
