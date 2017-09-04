/* 处理远程的服务接口 */

function get_server_service(url, post_data, func)
{
  $.ajax({
    url: url,
    type: 'POST',
    async: true,
    data:{
        data: post_data
    },
    dataType:'html',    //返回的数据格式：json/xml/html/script/jsonp/text
    success:function(data, textStatus, jqXHR){
        console.log('Success:')
        console.log(data)
        console.log("textStatus: " + textStatus)
        //console.log(jqXHR)
        func(data);
    },
    error:function(xhr,textStatus){
        console.log('错误')
        console.log(xhr)
        console.log(textStatus)
    },
  })
}

function get_server_service_this(url, post_data, func, obj)
{
  $.ajax({
    url: url,
    type: 'POST',
    context: obj,
    async: true,
    data:{
        data: post_data
    },
    dataType:'html',    //返回的数据格式：json/xml/html/script/jsonp/text
    success:function(data, textStatus, jqXHR){
        console.log('Success:')
        console.log(data)
        console.log("textStatus: " + textStatus)
        //console.log(jqXHR)
        func.call(this, data);
    },
    error:function(xhr,textStatus){
        console.log('错误')
        console.log(xhr)
        console.log(textStatus)
    },
  })
}


function get_server_service_json(url, post_data, func)
{
  $.ajax({
    url: url,
    type: 'POST',
    async: false,
    data:{
        data: post_data
    },
    dataType:'json',    //返回的数据格式：json/xml/html/script/jsonp/text
    success:function(data, textStatus, jqXHR){
        console.log('Success:')
        console.log(data)
        console.log("textStatus: " + textStatus)
        
        func(data);
    },
    error:function(xhr,textStatus){
        console.log('错误')
        console.log(xhr)
        console.log(textStatus)
    },
  })
}


function UrlGetQueryString(name)
{
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = decodeURI(window.location.search).substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
}

/*
 * 使用JS下载文件
 * http://www.cnblogs.com/qq78292959/p/3890899.html
 */
function downloadFile(url) {
    try{
        var elemIF = document.createElement("iframe");
        elemIF.src = url;
        elemIF.style.display = "none";
        document.body.appendChild(elemIF);
    } catch(e) {
    } 
}

function is_email(txt) {
  var preg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/; //匹配Email
  if(!preg.test(txt))
    return false;
  return true;
}

