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
function check_loginname(field_name, label) {
	url = window.location.href;
	n = url.lastIndexOf("/");
	url = url.substr(0, n) + "/doesVendorExist.php?" + "field_name=" + field_name + "&fieldcontent=" + $("#"+field_name).val();
			
	get_server_service(url, "", function(data) {
		if (data == 1) {
			warning_message(label + '已存在，请使用不同的名称');
			
			$("#"+field_name).focus();
			$("#vendor_name").attr({"disabled":"disabled"});//注册按钮变灰不可用
		} else {
			$("#vendor_name").removeAttr("disabled");
		}

	});
}

/*
*注册用户验证
*/
function check_register(){
	if ($("#login_name").val() == "") {
		warning_message("登录名不能为空！");
		return false;
	}
	
	if ($("#password").val() == "") {
		warning_message("密码不能为空！");
		return false;
	}

	if ($("#vendor_name").val() == "") {
		warning_message("名称不能为空！");
		return false;
	}

	if ($("#email").val() == "") {
		warning_message("Email不能为空！");
		return false;
	}

	if (!is_email($("#email").val())) {
		warning_message("Email格式错误！");
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
	$("#reg_form").submit(check_register);

	$("#login_name").blur(function(){
		check_loginname('login_name', '登录名');
	});

	$("#vendor_name").blur(function(){
       		check_loginname('vendor_name', '名称');
        });
});
