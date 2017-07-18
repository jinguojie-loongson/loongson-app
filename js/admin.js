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
  var isExistAudit = $("#isExistAudit").val();// 1:"通过审核"按钮  2:"不通过审核"按钮  3:"下架"按钮
  var versionreview = $("#versionreview").val();
  var isappOfftheshelf = $("#isappOfftheshelf").val(); //1 app对应的版本下架  0:app下架
  var versionreplace = versionreview.replace(/\./g,'1');

  url = window.location.href;
  n = url.lastIndexOf("/");
  url = url.substr(0, n) + "/auditApp.php?" + "appid=" + appid+ "&isExistAudit=" + isExistAudit
	+ "&versionreview=" + versionreview
	+ "&comment=" + encodeURI(comment) 
	+ "&isappOfftheshelf="+isappOfftheshelf;
  console.log(url);

  get_server_service(url, "", function(data) {
    if (isappOfftheshelf == 1 ) { 
	$('#'+appid+versionreplace+'btnisdispay').html("");
	  if (isExistAudit == 1 ){//"+appid+","+versionreview+"
	     $('#'+appid+versionreplace+'updatestatus').html("通过审核");	
		$('#'+appid+versionreplace+'btnisdispay').html("<button type='button' onclick=\"offtheshelf("+appid+",'"+versionreview+"')\" "
			+" class='btn btn-danger off_the_shelf_appnew' data-toggle='modal'  data-target='#myModal' > 下架  </button>"
			+" <a href='#' title='审核信息'><span class='glyphicon glyphicon-list-alt' title='审核信息' class='btn btn-danger' "
			+" data-toggle='modal'  data-target='#myModal1' onclick='get_review_byappid("+appid+")'></span></a>");
	  } else if (isExistAudit == 2 ) {
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
    $("#isExistAudit").val("1");
    $("#appcomment_review").val("");
  });

  $(".NotAudit_app").click(function() {
    $("#appidforcommit").val($(this).parent().find("#app_id").val());
    $("#versionreview").val($(this).parent().find("#version").val());
    $("#isExistAudit").val("2");
    $("#appcomment_review").val("");
  });


  $(".off_the_shelf_app").click(function() {
    $("#appidforcommit").val($(this).parent().find("#app_id").val());
    $("#isExistAudit").val("3");
    $("#appcomment_review").val("");
	
  });

  $(".appofftheshelf").click(function() {
    $("#appidforcommit").val($(this).parent().find("#app_id").val());
    $("#versionreview").val($(this).parent().find("#version").val());
    $("#isExistAudit").val("3");
    $("#appcomment_review").val("");

  });

  $(".installscript").mouseenter(function(e) {
    var v_id = $(e.target).attr('class');
    if (v_id !="popover-content") {
      $("div[class*='popover']").popover("hide");
    }
    var divid = $(this).attr('id');
    $('#'+divid+'installisshow').popover('show');	
  });

  $(".unistallshow").mouseover(function(e) {
    var v_id = $(e.target).attr('class');
    if (v_id !="popover-content") {
      $("div[class*='popover']").popover("hide");
    }
    var divid = $(this).attr('id');
    $('#'+divid+'unistallisshow').popover('show');
  });

  $("#reviewbtn").click(review_comment);

  $(".Audit_app_del").click(function() {
    audit_app_del($(this), $(this).parent().find("#comment_id").val());
  });

  $(document).click(function(e) {
    var v_id = $(e.target).attr('class'); 
    if (v_id !="popover-content") {
      $("div[class*='popover']").popover("hide");
    }
  });
});

