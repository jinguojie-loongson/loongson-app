function audit_yes($btn, $id, audit)
{
  console.log("no: " + $id);
  url = "auditComment.php?id=" + $id + "&audit=" + (1 - audit);
  console.log(url);

  get_server_service(url, "", function() {
    if (audit == "1")
    {
      $btn.parent().find("#comment_audit").val("0");
      $btn.html("<div class='glyphicon glyphicon-eye-open'></div> " + "显 示");
    }
    else
    {
      $btn.parent().find("#comment_audit").val("1");
      $btn.html("<div class='glyphicon glyphicon-eye-open'></div> " + "隐 藏");
    }
  });
}

function audit_del($btn, $id)
{
  console.log("no: " + $id);
  url = "auditComment.php?id=" + $id + "&audit=del";
console.log(url);

  get_server_service(url, "", function() {
    $btn.closest("tr").remove();
  });
}

function audit_app($btn, $id)
{
  console.log("no: " + $id);
  url = "auditApp.php?id=" + $id;
  console.log(url);
  get_server_service(url, "", function() {
    $btn.closest("tr").find("#app_status").text("通过审核");
  });
}

function offtheshelf(appid,version)
{
  $("#appidforcommit").val(appid);
  //$("#versionreview").val(version);
  $("#isExistAudit").val("3");
  $("#appcomment_review").val("");
}

function appofftheself(appid)
{
  $("#appidforcommit").val(appid);
  $("#isExistAudit").val("3");
}

function cutString(str, len)
{
  //length属性读出来的汉字长度为1
  if (str.length * 2 <= len) {
    return str;
  }
  var strlen = 0;
  var s = "";
  for(var i = 0; i < str.length; i++) {
    s = s + str.charAt(i);
    if (str.charCodeAt(i) > 128) {
      strlen = strlen + 2;
        if(strlen >= len){
	  return s.substring(0, s.length-1) + "...";
	 }
     } else {
         strlen = strlen + 1;
	 if(strlen >= len){
	   return s.substring(0,s.length-2) + "...";
	 }
     }
  }
  return s;
}
function review_comment()
{
  var comment = $(".app-comment-input").text();
  var appid = $("#appidforcommit").val();
  var operation_type = $("#operation_type").val();// 1:"通过审核"按钮  2:"不通过审核"按钮  3:"下架"按钮
  var versionreview = $("#versionreview").val();
  var is_admin = $("#is_admin").val(); //1 app对应的版本下架  0:app下架
  var versionreplace = versionreview.replace(/\./g,'1');

  url = window.location.href;
  n = url.lastIndexOf("/");
  url = url.substr(0, n) + "/auditApp.php?" + "appid=" + appid+ "&operation_type=" + operation_type
	+ "&versionreview=" + versionreview
	+ "&comment=" + encodeURI(comment) 
	+ "&is_admin="+ is_admin;
  console.log(url);

  get_server_service(url, "", function(data) {
    if (is_admin == 1 ) { 
	$('#'+appid+versionreplace+'btnisdispay').html("");
	  if (operation_type == 'pass' ) {//"+appid+","+versionreview+"
	     $('#'+appid+versionreplace+'updatestatus').html("通过审核");	
	     $('#'+appid+versionreplace+'btnisdispay').html("<button type='button' onclick=\"offtheshelf("+appid+",'"+versionreview+"')\" "
			+" class='btn btn-danger appofftheshelf' data-toggle='modal'  data-target='#myModal' > 下架  </button>"
			+" <a href='#' title='审核信息'><span class='glyphicon glyphicon-list-alt' title='审核信息' class='btn btn-danger' "
			+" data-toggle='modal'  data-target='#myModal1' onclick='get_review_byappid("+appid+")'></span></a>");
	  } else if (operation_type == 'not_pass' ) {
	    $('#'+appid+versionreplace+'btnisdispay').html("<a  href='#' title='审核信息'>"
		+" <span class='glyphicon glyphicon-list-alt' title='审核信息' "
		+" class='btn btn-danger' data-toggle='modal'  data-target='#myModal1' "
		+" onclick='get_review_byappid("+appid+")'></span></a>");
		$('#'+appid+versionreplace+'updatestatus').html("未通过审核");
	  } else {
	       $('#'+appid+versionreplace+'btnisdispay').html("<a  href='#' title='审核信息'>"
		+" <span class='glyphicon glyphicon-list-alt' title='审核信息' "
	        +" class='btn btn-danger' data-toggle='modal'  data-target='#myModal1' "
		+" onclick='get_review_byappid("+appid+")'></span></a>");
		$('#'+appid+versionreplace+'updatestatus').html("已下架");
	  }
    } else {
	$('#'+appid+'img').prepend("<p><span class='badge pull-right'>已下架</span></p>");
	$('#'+appid+'offtheshelfbtn').attr("disabled", true);
    }
  });		

  $('#myModal').modal('hide');
}

function updateVendorIsActive(vendor_id, isActive)
{
  url = window.location.href;
  n = url.lastIndexOf("/");
  url = url.substr(0, n) + "/updateVendorIsActive.php?" + "vendor_id=" + vendor_id + "&isActive=" + isActive;

  var button_id = "button_" + vendor_id;
  /*
   * 修改状态，返回html
   */
  get_server_service(url, "", function(data) {
    if (data == 1) {
      $("#"+button_id).html("");
      $("#"+button_id).html("<button type='button' class='btn btn-success' onclick='updateVendorIsActive(" + vendor_id + ", 0)'>激活</button>");
      success_message("已停用！");
    } else {
      $("#"+button_id).html("");
      $("#"+button_id).html("<button type='button' class='btn btn-danger' onclick='updateVendorIsActive(" + vendor_id + ", 1)'>停用</button>");
      success_message("已激活！");
    }
  });
}
$(document).ready(function(){
  console.log($(".Audit_yes").length);
  $(".Audit_yes").click(function() {
    audit_yes($(this), $(this).parent().find("#comment_id").val(),
                       $(this).parent().find("#comment_audit").val());
  });

  $(".Audit_del").click(function() {
    audit_del($(this), $(this).parent().find("#comment_id").val());
  });

  $(".Audit_app").click(function() {
    $("#appidforcommit").val($(this).parent().find("#app_id").val());
    $("#versionreview").val($(this).parent().find("#version").val());
    $("#operation_type").val("pass");
    $("#appcomment_review").empty();
  });

  $(".NotAudit_app").click(function() {
    $("#appidforcommit").val($(this).parent().find("#app_id").val());
    $("#versionreview").val($(this).parent().find("#version").val());
    $("#operation_type").val("not_pass");
    $("#appcomment_review").empty();
  });


  $(".off_the_shelf_app").click(function() {
    $("#appidforcommit").val($(this).parent().find("#app_id").val());
    $("#operation_type").val("off_the_shelf");
    $("#appcomment_review").empty();
	
  });

  $(".appofftheshelf").click(function() {
    $("#appidforcommit").val($(this).parent().find("#app_id").val());
    $("#versionreview").val($(this).parent().find("#version").val());
    $("#operation_type").val("off_the_shelf");
    $("#appcomment_review").empty();

  });

  $(".installscript").mouseenter(function(e) {
    var v_id = $(e.target).attr('class');
    if (v_id !="popover-content") {
      $(".popover").popover("hide");
    }
    var divid = $(this).attr('id');
    $('#'+divid+'installisshow').popover('show');	
  });

  $(".unistallshow").mouseenter(function(e) {
    var v_id = $(e.target).attr('class');
    if (v_id !="popover-content") {
      $(".popover").popover("hide");
    }
    var divid = $(this).attr('id');
    $('#'+divid+'unistallisshow').popover('show');
  });
 
  $(".Audit_app_del").click(function() {
    audit_app_del($(this), $(this).parent().find("#comment_id").val());
  });

  $("#reviewbtn").click(review_comment);

  $(document).click(function(e) {
    var v_id = $(e.target).attr('class'); 
    if (v_id !="popover-content") {
      $("div[class*='popover']").popover("hide");
    }
  });

  /*
   * 操作系统-新增-判断input
   */
  $("#os_name").blur(function(){
    check_os_name_input(0, $("#os_name").val(), "add_query");
  });

  $("#os_name").focus(function(){
    $("#os_name_text").html("");
  });

  $("#edit_os_name").blur(function(){
    check_os_name_input($("#edit_os_id").val(), $("#edit_os_name").val(), "update_query");
  });

  $("#edit_os_name").focus(function(){
    $("#edit_os_name_text").html("");
  });

  $("#os_description").blur(function(){
    check_os_description_input($("#os_description").val(), "add_query");
  });

  $("#os_description").focus(function(){
    $("#os_description_text").html("");
  });

  $("#edit_os_description").blur(function(){
    check_os_description_input($("#edit_os_description").val(), "update_query");
  });

  $("#edit_os_description").focus(function(){
    $("#edit_os_description_text").html("");
  });

  $("#os_probe_cmd").blur(function(){
    check_os_probe_cmd_input($("#os_probe_cmd").val(), "add_query");
  });

  $("#os_probe_cmd").focus(function(){
    $("#os_probe_cmd_text").html("");
  });

  $("#edit_os_probe_cmd").blur(function(){
    check_os_probe_cmd_input($("#edit_os_probe_cmd").val(), "update_query");
  });

  $("#edit_os_probe_cmd").focus(function(){
    $("#edit_os_probe_cmd_text").html("");
  });

  $("#saveOs").on("click", function(){
    var state_name = "true";
    var state_description = "true";
    var state_probe_cmd = "true";
    state_description = check_os_description_input($("#os_description").val(), "add_query");
    state_probe_cmd = check_os_probe_cmd_input($("#os_probe_cmd").val(), "add_query");

    var os_name = $.trim($("#os_name").val());
    var os_description = $.trim($("#os_description").val());
    var os_probe_cmd = $.trim($("#os_probe_cmd").val());

    if (os_name == null || os_name == "") {
      state_name = "false";
      $("#os_name_text").html("系统名称不能为空！");
    }
    if (state_name != "false" && state_description != "false" && state_probe_cmd != "false") {
      var os_json={
        "os_json":{
                    "name" : os_name,
                    "description" : os_description,
                    "probe_cmd" : os_probe_cmd
                   }
      };
      var obj=JSON.stringify(os_json);

      url = window.location.href;
      n = url.lastIndexOf("/");
      url = url.substr(0, n) + "/addOs.php?";

      get_server_service(url, obj, function(data) {
        if (data == "false") {
          $("#os_name_text").html("系统名称不能重复！");
        } else {
          $(".table").append(data);
          $("#os_name").val("");
	  $("#os_description").val("");
	  $("#os_probe_cmd").val("");
        }
      });
    }
  });

  $("#modify_os_submit").on("click", function(){
    var state_name = "true";
    var state_description = "true";
    var state_probe_cmd = "true";
    state_description = check_os_description_input($("#edit_os_description").val(), "update_query");
    state_probe_cmd = check_os_probe_cmd_input($("#edit_os_probe_cmd").val(), "update_query");

    var os_name = $.trim($("#edit_os_name").val());
    var os_description = $.trim($("#edit_os_description").val());
    var os_probe_cmd = $.trim($("#edit_os_probe_cmd").val());
    var os_id = $("#edit_os_id").val();

    if (os_name == null || os_name == "") {
      state_name = "false";
      $("#edit_os_name_text").html("系统名称不能为空！");
    }
    if (state_name != "false" && state_description != "false" && state_probe_cmd != "false") {
      var os_json={
        "os_json":{
                    "os_name" : os_name,
                    "os_description" : os_description,
                    "os_probe_cmd" : os_probe_cmd
                   }
      };
      var obj=JSON.stringify(os_json);

      url = window.location.href;
      n = url.lastIndexOf("/");
      url = url.substr(0, n) + "/getOrModifyOs.php?" + "os_id=" + os_id + "&state=update";

      get_server_service_json(url, obj, function(data) {
        if (data.return == "true") {
          $('#myModal').modal('hide');
          $('#os_name_' + os_id).html(data.os_name);
	  $('#os_description_' + os_id).html(data.os_description);
	  $('#os_probe_cmd_' + os_id).html(data.probe_cmd);
        } else {
          $("#edit_os_name_text").html("系统名称不能重复！");
        }
      });
    }
  });

  $("#os_table").on("click","#del_button", function(){
    var os_id = $(this).parent().find("input[name='os_id']").val();
    var btn = $(this);
    url = window.location.href;
    n = url.lastIndexOf("/");
    url = url.substr(0, n) + "/deleteOs.php?" + "os_id=" + os_id;

    get_server_service(url, "", function(data) {
      if (data == "false") {
        fail_message("该操作系统已经被使用不能删除！");
      } else {
        btn.closest("tr").remove();
        success_message("删除成功！");
      }
    });
  });

  $("#os_table").on("click", "#edi_button", function(){
    $("#edit_os_name").val("");
    $("#edit_os_description").val("");
    $("#edit_os_probe_cmd").val("");
    $("#edit_os_id").val("");
    $("#os_name_text").html("");
    $("#edit_os_description_text").html("");
    $("#edit_os_probe_cmd_text").html("");
    var os_id = $(this).parent().find("input[name='os_id']").val();
    url = window.location.href;
    n = url.lastIndexOf("/");
    url = url.substr(0, n) + "/getOrModifyOs.php?" + "os_id=" + os_id + "&state=query";

    get_server_service_json(url, "", function(data) {
      if (data.return == "true") {
        $("#edit_os_name").val(data.os_name);
	$("#edit_os_description").val(data.os_description);
	$("#edit_os_probe_cmd").val(data.probe_cmd);
	$("#edit_os_id").val(data.os_id);
      }
    });

  });
});

function check_os_probe_cmd_input(probe_cmd, type)
{
  var state = "true";
  var os_probe_cmd = $.trim(probe_cmd);
  if (os_probe_cmd == null || os_probe_cmd == "") {
    if (type == "add_query") {
      $("#os_probe_cmd_text").html("探测脚本不能为空！");
    } else {
      $("#edit_os_probe_cmd_text").html("探测脚本不能为空！");
    }
    state = "false";
  }
  return state;
}

function check_os_description_input(description, type)
{
  var state = "true";
  var os_description = $.trim(description);
  if (os_description == null || os_description == "") {
    if (type == "add_query") {
      $("#os_description_text").html("系统描述不能为空！");
    } else {
      $("#edit_os_description_text").html("系统描述不能为空！");
    }
    state = "false";
  }
  return state;
}

function check_os_name_input(os_id, name, type)
{
  var state = "true";
  var os_name = $.trim(name);
  if (os_name != null && os_name != "") {
    check_os_name(os_id, os_name, type);
  } else {
    if (type == "add_query") {
      $("#os_name_text").html("系统名称不能为空！");
    } else {
      $("#edit_os_name_text").html("系统名称不能为空！");
    }
    state = "false";
  }
  return state;
}

function check_os_name(os_id, os_name, type)
{
  var os_json = {
        "os_json":{
                    "name" : os_name
                   }
  };
  var obj = JSON.stringify(os_json);

  url = window.location.href;
  n = url.lastIndexOf("/");
  url = url.substr(0, n) + "/checkOsName.php?" + "id=" + os_id + "&type=" + type;

  get_server_service(url, obj, function(data) {
    if (data != 0) {
      if (type == "add_query") {
        $("#os_name_text").html("系统名称不能重复！");
      } else {
        $("#edit_os_name_text").html("系统名称不能重复！");
      }
    }
  });
}
