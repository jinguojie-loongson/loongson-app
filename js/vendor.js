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

    /* 获取被选中的系统id*/
    var chk_value =[];
    $('input[name="selectOs"]:checked').each(function(){
      chk_value.push($(this).val());
    });

    var state = versionCheck(local_version);
    if (state == "true") {
      if (chk_value.length != 0) {
        $.each(chk_value, function(n, value){
	  var version_state = status_check_version(state, $("#app_status_" + value).val(), local_version, $("#app_version_" + value).val(), $("#os_name_" + value).val());
	  return version_state;
	});
      }
    } 
  });

  /*
   * 勾选操作系统时触发事件
   */
  $('[data-type="checkbox"]').click(function(){
    var local_version = $("#local_version").val();
    if ($.trim(local_version) != null && $.trim(local_version) != "") {
      var state = versionCheck(local_version);
      if (state == "true") {
        var version_state = status_check_version
		(state, $("#app_status_" + $(this).val()).val(), local_version, $("#app_version_" + $(this).val()).val(), $("#os_name_" + $(this).val()).val());
      }
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
      $("#stateDomain").html("当前状态为：未审核。不能上传新版本！");
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

    /*脚本命令基于系统，至少有一个系统支持  osfun.checkOs()*/
    var data = table_fun.table_val();

    if (data == "") {
      state="false";
    } else {
      var tmp = "<input type='hidden' name='os_content' id='os_content' value='"+data+"'  />";
      $("#uploadForm").append(tmp);
    }

    if (state == "false") {
      warning_message("未添加应用文件以及安装卸载信息！");
      return false;
    }

    if (state == "true") {
      $("#longdesc").val(longdesc);
      $("#appSubmit").attr("disabled","disabled");
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
      /*脚本命令基于系统，至少有一个系统支持  osfun.checkOs()*/
      var data = table_fun.table_val();

      if (data == "") {
        state="false";
      } else {
        var tmp = "<input type='hidden' name='os_content' id='os_content' value='"+data+"'  />";
        $("#uploadModifyForm").append(tmp);
      }

      if (state == "false") {
        warning_message("未添加应用文件以及安装卸载信息！");
        return false;
      }
      if (state == "true") {
        $("#uploadOrModify").attr("disabled","disabled");
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
        $("#uploadOrModify").attr("disabled","disabled");
        $("#uploadModifyForm").submit();
      }
    } else {
      alert("参数错误！"); 
    }
  });
 
  /*
   * 取消
   */
  $(".cancel").on("click",function(){
     window.location.href = "vendorWorkbench.php";
  });

  /*
   * 当参数错误或者不存在该应用的时候，页面需要隐藏一些标签
   */
  var error = $("#error").val();
  if(error == "error"){
    $("#title").hide();
    $("#version_title").hide();
    $(".btn-primary").hide();
  }

  $(".reviewmessage").on("click",function(){
    var appid = $(this).attr('id');
	$.ajax({
          type: "post",
          url: "getReviewHtml.php",
          data: {"appid":appid},
          async : false,
          dataType: "text",
        success: function (data ,textStatus, jqXHR)
        {
                $("#reviewdiv").html(data);
        },
        error:function (XMLHttpRequest, textStatus, errorThrown) {
            alert("请求失败！"+XMLHttpRequest+"==="+textStatus+"==="+errorThrown);
        }
     });
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
function status_check_version(state, his_status, local_version, his_version, os_name)
{
  if (his_status == "published" || his_status == "off_the_shelf") {
    var version_contrast = app_version_compare(local_version, his_version);
    if (version_contrast != 1) {
      $("#stateDomain").html("当前版本号，不能小于等于 " + os_name + " 的版本号！");
      state = "false";
    }
  } else if (his_status == "rejected") {
    if ($.trim(local_version) != $.trim(his_version)) {
      var version_contrast = app_version_compare(local_version, his_version);
      if (version_contrast != 1) {
        $("#stateDomain").html("当前版本号，不能小于 " + os_name + " 的版本号！");
        state = "false";
      }
    }

  } else if (his_status == "under_review") {
      $("#stateDomain").html(os_name + "系统的当前状态为：未审核。不能上传新版本！");
      state = "false";
  } else {
      $("#stateDomain").html("当前状态无效！");
      state = "false";
  }
  return state;
}
 
function get_review_byappid(appid)
{
    $.ajax({
        type: "post",
        url: "getReviewHtml.php",
        data: {"appid":appid},
        async : false,
        dataType: "text",
        success: function (data ,textStatus, jqXHR)
        {
		$("#reviewdiv").html(data);	
        },
        error:function (XMLHttpRequest, textStatus, errorThrown) {
            alert("请求失败！"+XMLHttpRequest+"==="+textStatus+"==="+errorThrown);
        }
    });
}

/*
 *  多分类处理
 */
var categoryArray=new Array();
var categoryfun={
  slt:function(span){
    if ($(span).hasClass('checked')) {
      span.className='unchecked';
      categoryArray.splice($.inArray($(span).attr('value'),categoryArray),1);
    } else {
      span.className='checked';
      categoryArray.push($(span).attr('value'));
    }

    obj[$(span).attr('name')]=categoryArray.join(',');
    $("#category_id").val(categoryArray.join(','));
  }
}

/*
 * 选择系统二
 */
var os_fun={
  /*系统静态代码块*/
  auto_addOs:function(current_os_id, current_os_name, count, page_state, app_version, app_status){
    var add_version_html = "";
    var add_input_html = "";
    if (page_state == "new_version") {
      var input_app_version_name = "app_version_" + current_os_id;
      var input_app_status_name = "app_status_" + current_os_id;
      var input_os_name = "os_name_" + current_os_id;
      add_version_html = "<span style='color: gray;'>(已有版本：" + app_version + " )</span>"
	+ " <input type='hidden' id='" + input_app_version_name + "' name='" + input_app_version_name + "' value='" + app_version + "'>"
	+ " <input type='hidden' id='" + input_app_status_name + "' name='" + input_app_status_name + "' value='" + app_status + "'>"
	+ " <input type='hidden' id='" + input_os_name + "' name='" + input_os_name + "' value='" + current_os_name + "'>"
	+ " <input type='hidden' name='page_state' value='" + page_state + "'>";

      add_input_html = "<input type='checkbox' name='selectOs' id='selectOs"+current_os_id+"' data-type='checkbox' value='"+current_os_id+"' osname='"+current_os_name+"'  count='"+count+"'/>";
    } else {
      add_input_html = "<input type='checkbox' name='selectOs' id='selectOs"+current_os_id+"' value='"+current_os_id+"' osname='"+current_os_name+"'  count='"+count+"'/>";

    }
    var html = "<div id='modular_os_"+current_os_id+"'>"
	+ " <div class='vendor-app-file-attribute' id = 'os_t_"+current_os_id+"'>"
        + " <span class='version'>"
	+ add_input_html
	+ current_os_name
	+ " </span>"
	+ add_version_html
        + " </div>"
        + " <input type='hidden' id='os_id' name='os_id' value='"+current_os_id+"'>"
        + " <div class='vendor-app-file-attribute' id = 'os_i_"+current_os_id+"'>"
        + " <span>安装脚本(shell命令)：</span><input class='vendor-card-input' type='text' id='install_script_"+current_os_id+"' name='install_script' readonly='readonly'>"
        + " </div>"
        + " <div class='vendor-app-file-attribute' id='os_u_"+current_os_id+"'>"
        + " <span>卸载脚本(shell命令)：</span><input class='vendor-card-input' type='text' id='uninstall_script_"+current_os_id+"' name='uninstall_script'  readonly='readonly'>"
        + " </div></div>";
    $(".vendor-app-file-div").append(html);
  },

  /*所有操作系统使用相同的安装命令静态代码块*/
  auto_allOs:function(){
    var html = "<div class='vendor-app-file-attribute' >"
	+ " <input type='checkbox' name='selectAllOs' id='selectAllOs'  />所有操作系统使用相同的安装命令"
        + " </div>";
    $(".vendor-app-file-div").append(html);
  },

  /*按钮静态代码块*/
  auto_btn:function(){
    var html = "<div style=' text-align:left'><button class='btn btn-primary' type='button' id='addCase'>添加</button>"
	+ " </div>";
        /*<button class='btn btn-warning' type='button'id='cancel' > 删除</button>*/
    $(".vendor-app-file-div").append(html);
  },

  /*添加事件，复选框，按钮*/
  selector_event:function(){
    /*添加按钮事件*/
    $("#addCase").on('click',os_fun.add_OsList);
    /*取消按钮事件*/
    //$("#cancel").on('click',os_fun.mv_table_tr);
    /*测试按钮*/
    /*$("#testdata").on('click',table_fun.table_val);*/
    /*构选 “所有操作系统使用相同的安装命令” 时其他的框同时显示，第一个选择填写的命令信息*/
    $("#selectAllOs").on('click',os_fun.select_allOs);
    /*复选框添加事件*/
    $(os_fun.get_all_ckbox()).each(function(){
      $(this).on('change',function(){
        os_fun.selector_ckbox(this);
      });
    });
  },

  /*选择事件*/
  selector_ckbox:function(ckbox){
    /* 选中系统ID*/
    var slt_id = $(ckbox).val();
    if ($(ckbox).is(':checked')) {
      /*被选择取消只读*/
      $("#install_script_"+slt_id).removeAttr("readonly");
      $("#uninstall_script_"+slt_id).removeAttr("readonly");
    } else {
      /*取消选择取消只读*/
      $("#install_script_"+slt_id).attr("readonly","readonly");
      $("#uninstall_script_"+slt_id).attr("readonly","readonly");
    }
  },

  /*获取所有os 复选框*/
  get_all_ckbox:function(){
    var allosArr = new Array();
    $("input[name='selectOs']").each(function(){
      allosArr.push($(this));
    });
    return allosArr;
  },

  /*获取被选中的复选框*/
  get_selectorOs:function(){
    var osArr = new Array();
    $(os_fun.get_all_ckbox()).each(function(){
      if($(this).is(':checked')){
        osArr.push($(this));
      }
    });
    return osArr;
  },

  /*获得选择复选框添加到列表页面*/
  add_OsList:function(){
    /*添加到表格前数据检查*/
    if (!os_fun.check_os_value()) return false;

    /*所有选择的复选框*/
    var allos= os_fun.get_selectorOs();
    /* 选择所有操作系统使用相同的安装命令*/
    /* if ($("#selectAllOs").is(':checked')) {
         var fristosid = os_fun.find_frist();
         获取命令信息
         var osmsg = os_fun.get_value(fristosid);

         $(allos).each(function(){
           osmsg[1]=$(this).attr("osname");//1 系统名称
           添加一行数据前先清除，重复数据
           table_fun.mv_row($(this).val());
           table_fun.add_row(osmsg);
          });
        }*/
    /*常规选择*/
    // else{
    $(allos).each(function(){
      var osmsg = os_fun.get_value($(this).val());

      osmsg[1] = $(this).attr("osname");//1 系统名称
      /*添加一行数据前先清除，重复数据*/
      table_fun.mv_row($(this).val());
      table_fun.add_row(osmsg);
    });
    // }

    //添加之后的处理工作 调用些方法默认认为以上全部为正确情况的
    os_fun.add_after_selector();
  },

  add_after_selector:function(){
    /*所有选择的复选框*/
    var allos= os_fun.get_selectorOs();

    $(allos).each(function(){
      // 1. 清空上文件文件名，上次文件大小，版本号,安装卸载脚本
      os_fun.clean_value($(this).val());

      // 2. 隐藏已添加后的系统选择框
      $("#modular_os_"+$(this).val()).hide();

    });
  },

  /*删除一行驱动方法*/
  mv_table_tr:function(){
    var allos= os_fun.get_selectorOs();
    $(allos).each(function(){
      table_fun.mv_row($(this).val());
    });
  },

  /*重载删除表格方法*/
  mv_table_tr:function(osid){
    table_fun.mv_row(osid);
    os_fun.mv_table_tr_after(osid)
  },

  mv_table_tr_after:function(osid){
    // 显示 添加系统命令页面
    $("#modular_os_"+osid).show();
    //回显删除后的数据
  },

  /*获取 文件信息，系统信息，命令信息*/
  get_value:function(id){
    var install_script = $("#install_script_"+id).val();
    var uninstall_script =$("#uninstall_script_"+id).val();

    var file_name = $("#file_name").val();
    var file_size = $("#file_size").val();

    var page_state = $('input[name="page_state"]').val();
    var version = "";
    if (page_state != null && page_state != "") {
      version = $("#local_version").val();
    } else {
      version = $("#version").val();
    }

    var osmsg  = new Array(7);

    osmsg[0]=id;//系统id

    //osmsg.push($(this).attr("osname"));// 1 系统名称
    osmsg[2]=version;//2 版本号
    osmsg[3]=file_name;//3 安装文件名
    osmsg[4]=file_size+"KB";//4 文件大小
    osmsg[5]=install_script;//5 安装命令
    osmsg[6]=uninstall_script;// 6 卸载命令
    return osmsg;
  },

  /* 清空选择*/
  clean_value:function(id){
    $("#install_script_"+id).val("");
    $("#uninstall_script_"+id).val("");
    $("#file_name").val("");
    $("#file_size").val("");
    // 直接暴力删除
    $("#file_show_name").empty();
    $("#file_show_size").empty();
    $("#version").val("");
    $("#local_version").val("");
    //$("#selectOs"+id).attr("checked",false);
    document.getElementById("selectOs"+id).checked=false
  },

  /*检查选择命令信息*/
  check_os_value:function(){
    var state = true ; // true 通过，false 不通过
    var allos= os_fun.get_selectorOs();

    /*选择校验*/
    if ($(allos).length == 0) {
      alert("未选择系统！");
      return false;
    }
    /*检查命令*/
    /*if ($("#selectAllOs").is(':checked')) {
        //第一个有效
        var frist_select_os_id = os_fun.find_frist();
        state = os_fun.validation_cmd(frist_select_os_id);
        if(!state) alert("选择“所有操作系统使用相同的安装命令”选项时，命令行必须在第一个选择系统的输入命令框中！");
      }*/
    /*常规选择，必须填写命令*/
    // else{
    /* 此处循环，一次校验一个系统，返回的数据中有 true 也有false */
      var flgarr = new Array();
      $(allos).each(function(){
        var os_id = $(this).val();
	flgarr.push(os_fun.validation_cmd(os_id));
      });
      /*如果包含false,返回 false 表示校验不通过*/
      if(flgarr.indexOf(false)!=-1)
        state=false;
      // }
      return state;
  },

  /*命令框校验*/
  validation_cmd:function(os_id){
    var flg=true;
    /*命令框检查*/
    var install_script = $("#install_script_"+os_id).val();
    var uninstall_script =$("#uninstall_script_"+os_id).val();
    if (install_script == null || install_script == "") {
      $("#install_script_"+os_id).css("border","1px solid red");
      /*添加取消样式*/
      $("#install_script_"+os_id).click(function(){
        $("#install_script_"+os_id).css("border","");
      });
      flg=false;
    }

    if (uninstall_script == null || uninstall_script == "") {
      $("#uninstall_script_"+os_id).css("border","1px solid red");
      $("#uninstall_script_"+os_id).click(function(){
        $("#uninstall_script_"+os_id).css("border","");
      });
      flg=false;
    }
    /*上传应用文件检查*/
    var file_name = $("#file_name").val();
    var file_size = $("#file_size").val();
    if ((file_name == null || file_name == "") && 
          (file_size == null || file_size == "")) {
      $(".app-file-button").css("border","1px solid red");
      flg=false;
    }
    /*版本号检查*/
    var page_state = $('input[name="page_state"]').val();
    var version_state = "";
    if (page_state != null && page_state != "") {
      var local_version = $("#local_version").val();
      version_state = versionCheck(local_version);

      /* 获取被选中的系统id*/
      var chk_value =[];
      $('input[name="selectOs"]:checked').each(function(){
        chk_value.push($(this).val());
      });

      if (version_state == "true") {
        if (chk_value.length != 0) {
          $.each(chk_value, function(n, value){
            version_state = status_check_version(version_state, $("#app_status_" + value).val(), local_version, $("#app_version_" + value).val(), $("#os_name_" + value).val());
          });
        }
      }

    } else {
      version_state = versionCheck($("#version").val());
    }

    if (version_state != "true") {
      flg=false;
    }

    return flg;
  },

  /* 查找第一个选择的系统元素*/
  find_frist:function(){
    var os_id;
    var allos= os_fun.get_selectorOs();
    var tmp = 0;
    $(allos).each(function(){
      if (tmp == 0) {
        tmp = $(this).attr('count');// 编号
        os_id = $(this).val(); // 系统id
        return true;
      }

      if (tmp > $(this).attr('count')) {
        tmp = $(this).attr('count');
        os_id = $(this).val(); // 系统id
      }
    });
    return os_id;
  },

  /*选择 “所有操作系统使用相同的安装命令” 操作事件*/
  select_allOs:function(){
    /* 第一个选择的系统元素*/
    var fristosid = os_fun.find_frist();
    /*所有选择的复选框*/
    var allos= os_fun.get_selectorOs();
    /*获取命令信息  */
    var osmsg = os_fun.get_value(fristosid);
    if ($(this).is(':checked')) {
      $(allos).each(function(){
        /*回显*/
        os_fun.replay_view($(this).val(),osmsg);
      });
    }/*取消选择*/
    else {
      $(allos).each(function(){
        /*取消回显*/
        if($(this).val()!=osmsg[0])
	os_fun.clean_script($(this).val());
      });
    }
  },

  replay_view:function(id,data){
    $("#install_script_"+id).val(data[5]);
    $("#uninstall_script_"+id).val(data[6]);
  },

  clean_script:function(id){
    $("#install_script_"+id).val("");
    $("#uninstall_script_"+id).val("");
  }
}

/*
 * 操作系统列表
 */
var table_fun={
  /*加入一行*/
  add_row:function(data){
    var tr =  "<tr osid='"+data[0]+"'>"
	+ " <td>"+data[1]+"</td>"
	+ " <td>"+data[2]+"</td>"
	+ " <td>"+data[3]+"</td>"
	+ " <td>"+data[4]+"</td>"
	+ " <td width='25%'>"+data[5]+"</td>"
	+ " <td width='25%'>"+data[6]+"</td>"
	+ " <td>"
	+ " <div class='btn Audit_del ' onclick='os_fun.mv_table_tr(\""+data[0]+"\")'>"
	+ " 删 除"
	+ " </div>"
	+ " </td>"
	+ " </tr>";
    $('table').append(tr);
  },

  /*删除一行*/
  mv_row:function(osid){
    $('table tr').each(function(){
      var trosid = $(this).attr('osid');
      if (typeof(trosid)=="undefined")
        return true;

      if ($(this).attr('osid')==osid)
        $(this).remove();
    });
  },

  /*获取table值*/
  table_val:function(){
    var data = new Array();
    var tmp=0;
    $('table tr').each(function(){
      /*跳过表头*/
      if (tmp==0) {
        tmp++;
        return true;
      }
      var tdarr = $(this).children('td');

      data.push($(this).attr('osid')
	+ "::"
	+ tdarr.eq(0).text()
	+ "::"
	+ tdarr.eq(1).text()
	+ "::"
	+ tdarr.eq(2).text()
	+ "::"
	+ tdarr.eq(3).text()
	+ "::"
	+ tdarr.eq(4).text()
	+ "::"
	+ tdarr.eq(5).text());
    });
    return data.join("#");
  }
}
