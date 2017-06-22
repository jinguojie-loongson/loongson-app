function check_login() {
	if ($("#loginname").val() == "")
	{
		warning_message("用户名不能为空！");
		return false;
	}

	if ($("#password").val() == "")
	{
		warning_message("密码不能为空！");
		return false;
        }

	return true;
}

/*	
*注册用户时用户名和名称在光标离开验证数据的唯一性
*/	
function check_loginname(field_name, divname){
	url = window.location.href;
	n = url.lastIndexOf("/");
	url = url.substr(0, n) + "/doesVendorExist.php?" + "field_name=" + field_name + "&fieldcontent=" + $("#"+field_name).val();
			
	get_server_service(url, "", function(data) {
		if (data == 1) {
			$("#"+divname).prepend("<script type='text/javascript'>alert('数据库中已存在');</script>");
			
			$("#vendor_name").attr({"disabled":"disabled"});//注册按钮变灰不可用
		}else{
		
			$("#vendor_name").removeAttr("disabled");
		}

	});
}

/*
*注册用户验证
*/
function check_form(){
	if($("#login_name").val()==""){
		alert("用户名不能为空！");
		return false;
	}
	
	if($("#password").val()==""){
		alert("密码不能为空！");
		return false;
	}

	if($("#vendor_name").val()==""){
		alert("名称不能为空！");
		return false;
	}

	if($("#email").val()==""){
		alert("Email不能为空！");
		return false;
	}

	var preg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/; //匹配Email
		if(!preg.test($("#email").val())){ 
		alert("Email格式错误！");
		return false;
	}
}

$(document).ready(function(){
	$("#vendor_loginform").submit(check_login);

	/* 注销 */
	if (window.location.href.indexOf("vendor_logout.php") != -1)
	{
		setTimeout(function() {
			console.log("hehe");
			window.location.href = 'vendor_login.php';
		}, 5000);
	}

	/* 注册页面 */
	$("#login_name").blur(function(){
		check_loginname('login_name','login_namediv');
	});

	$("#vendor_name").blur(function(){
       		check_loginname('vendor_name','vendor_namediv');
        });


	$("#returnbtn").click(function () {
		window.history.back();
	});
});
