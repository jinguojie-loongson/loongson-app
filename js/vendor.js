$(document).ready(function(){
  $("#vendor-name").mouseover(function(){
    $(".dropdown").slideDown(100);
  });

  $(document).click(function() {
    $(".dropdown").slideUp(100);
  });

  /*
   * 点击名称输入框，消失红色边框
   */
  $("#app_name").click(function(){
    $("#app_name").css("border","");
  });
  $("#app_name").focus(function(){
    $("#app_name").css("border","");
  });

  /*
   * 点击类别，取消红色边框
   */
   $(".unchecked").click(function(){
     $(".category-list").css("border","");
   });
   
  /*
   * 点击精简描述输入框，消失红色边框
   */
  $("#description").click(function(){
    $("#description").css("border","");
  });
  $("#description").focus(function(){
    $("#description").css("border","");
  });

  /*
   * 点击完整描述输入框，消失红色边框
   */
  $(".app-comment-input").click(function(){
    $(".app-comment-input").css("border","");
  });
  $(".app-comment-input").focus(function(){
    $(".app-comment-input").css("border","");
  });

  /*
   * 点击版本号输入框，消失红色边框
   */
  $("#version").click(function(){
    $("#stateDomain").html("");
  });
  $("#version").focus(function(){
    $("#stateDomain").html("");
  });
  $("#local_version").click(function(){
    $("#stateDomain").html("");
  });
  $("#local_version").focus(function(){
    $("#stateDomain").html("");
  });

  /*
   * 判断版本号是否合法
   */
  $("#version").blur(function(){
    versionCheck($("#version").val());
  });
  $("#local_version").blur(function(){
    var local_version = $("#local_version").val();
    var his_version = $("#his_version").val();
    var his_status = $("#his_status").val();

    var state = versionCheck(local_version);
    if (state == "true") {
      status_check_version(state, his_status, local_version, his_version);
    } 
  });

  /*
   * 点击安装脚本输入框，消失红色边框
   */
  $("#install_script").click(function(){
    $("#install_script").css("border","");
  });
  $("#install_script").focus(function(){
    $("#install_script").css("border","");
  });

  /*
   * 点击卸载脚本输入框，消失红色边框
   */
  $("#uninstall_script").click(function(){
    $("#uninstall_script").css("border","");
  });
  $("#uninstall_script").focus(function(){
    $("#uninstall_script").css("border","");
  });

  /*
   * 上传图片、文件封装
   * 《jQuery 1.9 .live() is not a function》
   * http://blog.csdn.net/dazhi_100/article/details/48970609
   */
  $('#photoimg').on('change', null, function(){
    var file_type = $("#file_type").val();
    var screen_number = $("#screen_number").val();
    if (file_type == "icon") {
      var status = $("#app-icon-status");
      status.show();

      $(".app-icon-preview").remove();
      $("#appIconName").remove();

      $("#imageform").ajaxForm({
        target: '.app-icon',
        success:function(){
                status.hide();
                $(".app-icon-button").hide();
                $(".app-icon-edit").show();
        }
      }).submit();

    } else if (file_type == "screen") {
      var status = $("#app-screen-status-"+screen_number);
      status.show();

      $(".app-screen-preview-"+screen_number).remove();
      $("#appScreenName"+screen_number).remove();
      
      $("#imageform").ajaxForm({
        target: '.app-screen-'+screen_number,
        success:function(){
                status.hide();
		$(".app-screen-button-"+screen_number).hide();
                $(".app-screen-edit-"+screen_number).show();
        }
      }).submit();
    } else if (file_type == "file") {
      $(".app-file-attribute").empty();
      $("#imageform").ajaxForm({
        target: '.app-file-attribute',
        success:function(){
        }
      }).submit();
    }
  });
  /*
   * 上传icon
   */
  $(".app-icon-button").click( function () {
    $("#file_type").val("icon");
    $(".app-icon").css("border","");
    $("#photoimg").trigger("click");
  });
  /*
   * 编辑icon
   */
  $("#app-icon-up").click(function(){
    $("#file_type").val("icon");
    $("#photoimg").trigger("click");
  });
  /*
   * 删除icon
   */
  $("#app-icon-del").click(function(){
    $(".app-icon-preview").remove();
    $("#appIconName").val("");
    $(".app-icon-button").show();
    $(".app-icon-edit").hide();
  });

  /*
   * 上传screen
   */
  $(".app-screen-button-1").click(function (){
    $("#file_type").val("screen");
    $("#screen_number").val("1");
    $(".app-screen-1").css("border","");
    $("#photoimg").trigger("click");
  });
  $(".app-screen-button-2").click(function (){
    $("#file_type").val("screen");
    $("#screen_number").val("2");
    $(".app-screen-1").css("border","");
    $("#photoimg").trigger("click");
  });
  $(".app-screen-button-3").click(function (){
    $("#file_type").val("screen");
    $("#screen_number").val("3");
    $(".app-screen-1").css("border","");
    $("#photoimg").trigger("click");
  });
  $(".app-screen-button-4").click(function (){
    $("#file_type").val("screen");
    $("#screen_number").val("4");
    $(".app-screen-1").css("border","");
    $("#photoimg").trigger("click");
  });
  $(".app-screen-button-5").click(function (){
    $("#file_type").val("screen");
    $("#screen_number").val("5");
    $(".app-screen-1").css("border","");
    $("#photoimg").trigger("click");
  });  

  /*
   * 删除screen
   */
  $("#app-screen-del-1").click(function(){
    $(".app-screen-preview-1").remove();
    $("#appScreenName1").val("");
    $(".app-screen-button-1").show();
    $(".app-screen-edit-1").hide();
  });
  $("#app-screen-del-2").click(function(){
    $(".app-screen-preview-2").remove();
    $("#appScreenName2").val("");
    $(".app-screen-button-2").show();
    $(".app-screen-edit-2").hide();
  });
  $("#app-screen-del-3").click(function(){
    $(".app-screen-preview-3").remove();
    $("#appScreenName3").val("");
    $(".app-screen-button-3").show();
    $(".app-screen-edit-3").hide();
  });
  $("#app-screen-del-4").click(function(){
    $(".app-screen-preview-4").remove();
    $("#appScreenName4").val("");
    $(".app-screen-button-4").show();
    $(".app-screen-edit-4").hide();
  });
  $("#app-screen-del-5").click(function(){
    $(".app-screen-preview-5").remove();
    $("#appScreenName5").val("");
    $(".app-screen-button-5").show();
    $(".app-screen-edit-5").hide();
  });


  
  /*
   * 上传file
   */ 
  $(".app-file-button").click(function(){
    $("#file_type").val("file");
    $(".app-file-button").css("border","");
    $("#photoimg").trigger("click");
  });
  $("#app_file_button").click(function(){
    var his_status = $("#his_status").val();
    if (his_status == "under_review") {
      $("#stateDomain").html("当前状态未：未审核。不能上传新版本！");
    } else {
      $("#file_type").val("file");
      $("#app_file_button").css("border","");
      $("#photoimg").trigger("click");
    }
  });
  
  /*
   * 提交
   */
  $("#appSubmit").on("click",function(){
    var state = "true";
    var appIconName = $("#appIconName").val();
    var app_name = $("#app_name").val();
    var category_id = $("#category_id").val();
    var description = $("#description").val();
    var longdesc =$(".app-comment-input").text();
    var appScreenName1 = $("#appScreenName1").val();
    var appScreenName2 = $("#appScreenName2").val();
    var appScreenName3 = $("#appScreenName3").val();
    var appScreenName4 = $("#appScreenName4").val();
    var appScreenName5 = $("#appScreenName5").val();
    var file_name = $("#file_name").val();
    var file_size = $("#file_size").val();
    var install_script = $("#install_script").val();
    var uninstall_script = $("#uninstall_script").val();
    
 
    if(appIconName == null || appIconName == ""){
      $(".app-icon").css("border","1px dashed red");
      state = "false";
    }
    if(app_name == null || app_name == ""){
      $("#app_name").css("border","1px solid red");
      state = "false";
    }
    if(category_id == null || category_id == ""){
      $(".category-list").css("border","1px solid red");
      state = "false";
    }
    if(description == null || description == ""){
      $("#description").css("border","1px solid red");
      state = "false";
    }
    if(longdesc == 0){
      $(".app-comment-input").css("border","1px solid red");
      state = "false";
    }
    if((appScreenName1 == null || appScreenName1 == "") && 
	(appScreenName2 == null || appScreenName2 == "") &&
	(appScreenName3 == null || appScreenName3 == "") && 
	(appScreenName4 == null || appScreenName4 == "") && 
	(appScreenName5 == null || appScreenName5 == ""))
    {
      $(".app-screen-1").css("border","1px dashed red");
      state = "false";
    }
    if((file_name == null || file_name == "") && 
	(file_size == null || file_size == ""))
    {
      $(".app-file-button").css("border","1px solid red");
      state = "false";
    }
    var version_state = versionCheck($("#version").val());
    if(install_script == null || install_script == ""){
      $("#install_script").css("border","1px solid red");
      state = "false";
    }
    if(uninstall_script == null || uninstall_script == ""){
      $("#uninstall_script").css("border","1px solid red");
      state = "false";
    }
    if(state == "true" && version_state == "true"){
      $("#longdesc").val(longdesc);
      $("#uploadForm").submit();
    }

  });

  /*
   * 上传新版本、修改信息 提交
   */
  $("#uploadOrModify").on("click",function(){
    var state = "true";
    
    var url_state = $("#state").val();

    if (url_state == "0") {
      var file_name = $("#file_name").val();
      var file_size = $("#file_size").val();
      var install_script = $("#install_script").val();
      var uninstall_script = $("#uninstall_script").val();

      var local_version = $("#local_version").val();
      var his_version = $("#his_version").val();
      var his_status = $("#his_status").val();

      if ((file_name == null || file_name == "") &&
        (file_size == null || file_size == ""))
      {
        $("#app_file_button").css("border","1px solid red");
        state = "false";
      }
      if (install_script == null || install_script == "") {
        $("#install_script").css("border","1px solid red");
        state = "false";
      }
      if (uninstall_script == null || uninstall_script == "") {
        $("#uninstall_script").css("border","1px solid red");
        state = "false";
      }
      var version_state = versionCheck(local_version);
      if (version_state == "true") {
        version_state = status_check_version(version_state, his_status, local_version, his_version);
      }

      if (state == "true" && version_state == "true") {
       $("#uploadModifyForm").submit(); 
      }
    } else if (url_state == "1") {
      var appIconName = $("#appIconName").val();
      var app_name = $("#app_name").val();
      var category_id = $("#category_id").val();
      var description = $("#description").val();
      var longdesc = $(".app-comment-input").text();
      var appScreenName1 = $("#appScreenName1").val();
      var appScreenName2 = $("#appScreenName2").val();
      var appScreenName3 = $("#appScreenName3").val();
      var appScreenName4 = $("#appScreenName4").val();
      var appScreenName5 = $("#appScreenName5").val();
      
      if (appIconName == null || appIconName == "") {
        $(".app-icon").css("border","1px dashed red");
        state = "false";
      }
      if (app_name == null || app_name == "") {
        $("#app_name").css("border","1px solid red");
        state = "false";
      }
      if (category_id == null || category_id == "") {
        $(".category-list").css("border","1px solid red");
        state = "false";
      }
      if (description == null || description == "") {
        $("#description").css("border","1px solid red");
        state = "false";
      }
      if (longdesc == 0) {
        $(".app-comment-input").css("border","1px solid red");
        state = "false";
      }
      if ((appScreenName1 == null || appScreenName1 == "") &&
        (appScreenName2 == null || appScreenName2 == "") &&
        (appScreenName3 == null || appScreenName3 == "") &&
        (appScreenName4 == null || appScreenName4 == "") &&
        (appScreenName5 == null || appScreenName5 == ""))
      {
        $(".app-screen-1").css("border","1px dashed red");
        state = "false";
      }
      
      if (state == "true") {
        $("#longdesc").val(longdesc);
        $("#uploadModifyForm").submit();
      }
    } else {
      
    }
  });
 
  /*
   * 取消
   */
  $(".cancel").on("click",function(){
     window.location.href = "vendorWorkbench.php";
  });

});

/*
 * 类别赋值
 */
var obj={
  category:""
};
function change(span)
{
  $('span[name="'+$(span).attr('name')+'"]').each(function(){
    {
      this.className="unchecked";
      this.checked=false;
    }               
  });
  obj[$(span).attr('name')]=$(span).attr('value');
  span.className="checked";
  span.checked=true;
  $("#category_id").val($(span).attr("value"));
}

function versionCheck($version) {
    var state = "true";
    var version = $version;
    var check = /[^\d.]/g;
    var check1 = /^\./g;
    var check2 = /\.{2,}/g;

    $("#stateDomain").html();
    if (check.test(version)){
      state = "false";
      $("#stateDomain").html("版本号只能输入数字和“.”!");
    }
    if (check1.test(version)) {
      state = "false";
      $("#stateDomain").html("版本号第一个字符必须是数字!");
    }
    if (check2.test(version)) {
      state = "false";
      $("#stateDomain").html("版本号不能连续出现多个“.”!");
    }

    if(version.split(".").length > 4){
      state = "false";
      $("#stateDomain").html("版本号最多4段数字!");
    }
    var lv = version.split(".");
    for(var i=0; i<lv.length; i++){
      if(parseInt(lv[i]) > 65535){
        state = "false";
        $("#stateDomain").html("版本号范围不能超过65535!");
      }
    }
    var last_str = version.substr(version.length-1,1);
    if(last_str == "."){
      state = "false";
      $("#stateDomain").html("版本号最后一位只能是数字!");
    }
    if(version.indexOf(".") == -1){
      state = "false";
      $("#stateDomain").html("版本号必须包含“.”!");
    }
    return state;
}

function app_version_compare(local_version, server_version)
{
  var lv = local_version.split(".");
  var sv = server_version.split(".");
  i = 0;
  while (i < lv.length && i < sv.length)
  {
    if (parseInt(lv[i]) < parseInt(sv[i]))
      return -1;
    if (parseInt(lv[i]) > parseInt(sv[i]))
      return 1;
    i++;
  }
  if (i < lv.length)
    return 1;
  if (i < sv.length)
    return -1;

  return 0;
}

/*
 * 根据应用的状态 判断版本号是否合法
 */
function status_check_version(state, his_status, local_version, his_version)
{
  if (his_status == "published" || his_status == "off_the_shelf" || his_status == "rejected") {
    var version_contrast = app_version_compare(local_version, his_version);
    if (version_contrast != 1) {
      $("#stateDomain").html("当前版本号，不能小于当前版本的版本号！");
      state = "false";
    }
  } else if (his_status == "under_review") {
      $("#stateDomain").html("当前状态未：未审核。不能上传新版本！");
      state = "false";
  } else {
      $("#stateDomain").html("当前状态无效！");
      state = "false";
  }
  return state;
}

