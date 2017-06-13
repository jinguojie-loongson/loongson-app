/* 客户端工具 */

function client_get_download_url()
{
  // http://localhost/app/php/client.php
  url = window.location.href;

  n = url.lastIndexOf("/");
  return url.substr(0, n) + "/downloadClient.php";
}

if (window.location.href.indexOf("client.php") != -1)
{
  $(document).ready(function(){
    $("#downloadClient").click(function() {
      console.log("#downloadClient");
      console.log(client_get_download_url());
      downloadFile(client_get_download_url());
    });
  });
}
