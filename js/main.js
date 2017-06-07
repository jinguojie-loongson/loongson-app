function UrlGetQueryString(name)
{
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = decodeURI(window.location.search).substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
}


$(document).ready(function() {

    /* 2017/6/7 首页广告轮播 */
    $(function() {
      $('#slides').slidesjs({
        width: 920,
        height: 400,
        navigation: true,
        pagination: {
          active: true,
          effect: "slide",
        },
        play: {
          active: false,
          auto: true,
          interval: 3000,
          effect: "slide",
        },
        preload: true,
        preloadImage: '../images/nopic.png',
        generateNextPrev: true,
        generatePagination: true
      });
    });

    $('#slides img').click(function() {
      window.location.href = $(this).attr("alt");
    });
});
