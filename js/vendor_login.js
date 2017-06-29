$(document).ready(function(){
	/* 注销 */
	if (window.location.href.indexOf("vendor_logout.php") != -1)
	{
		setTimeout(function() {
			console.log("hehe");
			window.location.href = 'vendor_login.php';
		}, 5000);
	}

	/* 注册页面 */
        $('#reg_form').bootstrapValidator({
　　　　　　　message: 'This value is not valid',
            　feedbackIcons: {
                　　　　　　　　valid: 'glyphicon glyphicon-ok',
                　　　　　　　　invalid: 'glyphicon glyphicon-remove',
                　　　　　　　　validating: 'glyphicon glyphicon-refresh'
            　　　　　　　　   },
              fields: {
                login_name: {
                    message: '用户名验证失败',
                    validators: {
                        notEmpty: {
                            message: '用户名不能为空'
                        },
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: '用户名长度必须在6到20位之间'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: '用户名只能包含大写、小写、数字和下划线'
                        },
                        remote: {
                            message: '用户名已被使用',
                            url: 'checkVendorFieldUniq.php',
                            delay: 2000,
                            type: 'POST'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: '密码不能为空'
                        },
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: '密码必须在6到20位之间'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: '密码只能包含大写、小写、数字和下划线'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: '电子邮件不能为空'
                        },
                        emailAddress: {
                            message: '邮箱地址格式有误'
                        },
                        remote: {
                            message: '电子邮件已被使用',
                            url: 'checkVendorFieldUniq.php',
                            delay: 2000,
                            type: 'POST'
                        }
                    }
                },
                vendor_name: {
                    message: '机构名称验证失败',
                    validators: {
                        notEmpty: {
                            message: '个人/机构名称不能为空'
                        },
                        stringLength: {
                            min: 2,
                            max: 50,
                            message: '长度必须在2到20位之间'
                        },
                        remote: {
                            message: '个人/机构名称已被使用',
                            url: 'checkVendorFieldUniq.php',
                            delay: 2000,
                            type: 'POST'
                        }

                    }
                }
            }
        });
	
	 $('#update_vendor_form').bootstrapValidator({
　　　　　　　message: 'This value is not valid',
            　feedbackIcons: {
                　　　　　　　　valid: 'glyphicon glyphicon-ok',
                　　　　　　　　invalid: 'glyphicon glyphicon-remove',
                　　　　　　　　validating: 'glyphicon glyphicon-refresh'
            　　　　　　　　   },
              fields: {
		    password_update: {
                    validators: {
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: '密码必须在6到20位之间'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: '密码只能包含大写、小写、数字和下划线'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: '电子邮件不能为空'
                        },
                        emailAddress: {
                            message: '邮箱地址格式有误'
                        },
                        remote: {
                            message: '电子邮件已经被使用',
                            url: 'doesVendorExistNotEqualVendorid.php',
                            delay: 2000,
                            type: 'POST'
                        }
                    }
                },
                vendor_name: {
                    message: '机构名称验证失败',
                    validators: {
                        notEmpty: {
                            message: '个人/机构名称不能为空'
                        },
                        stringLength: {
                            min: 2,
                            max: 50,
                            message: '长度必须在2到20位之间'
                        },
                        remote: {
                            message: '个人/机构名称已被使用',
                            url: 'doesVendorExistNotEqualVendorid.php',
                            delay: 2000,
                            type: 'POST'
                        }

                    }
                }
            }
        });

	 $('#forget_form').bootstrapValidator({
　　　　　　　message: 'This value is not valid',
            　feedbackIcons: {
                　　　　　　　　valid: 'glyphicon glyphicon-ok',
                　　　　　　　　invalid: 'glyphicon glyphicon-remove',
                　　　　　　　　validating: 'glyphicon glyphicon-refresh'
            　　　　　　　　   },
              fields: {
                 email_forfind: {
                    validators: {
                        notEmpty: {
                            message: '电子邮件不能为空'
                        },
                        emailAddress: {
                            message: '邮箱地址格式有误'
                        },
                        remote: {
                            message: '电子邮件没有被注册！',
                            url: 'doesEmailExist.php',
                            delay: 2000,
                            type: 'POST'
                        }
                    }
                }
	      }
        });
	 $('#updatepwd_form').bootstrapValidator({
　　　　　　　message: 'This value is not valid',
            　feedbackIcons: {
                　　　　　　　　valid: 'glyphicon glyphicon-ok',
                　　　　　　　　invalid: 'glyphicon glyphicon-remove',
                　　　　　　　　validating: 'glyphicon glyphicon-refresh'
            　　　　　　　　   },
              fields: {
	         newpassword : {
                          validators: {
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: '密码必须在6到20位之间'
                        },
		     identical: {//相同
                         field: 'pwdagain',
                         message: '两次密码不一致'
                     },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: '密码只能包含大写、小写、数字和下划线'
                        }
                    }
                },
		pwdagain: {
                          validators: {
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: '密码必须在6到20位之间'
                        },
		       identical: {//相同
                         field: 'newpassword',
                         message: '两次密码不一致'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: '密码只能包含大写、小写、数字和下划线'
                        }
                    }
                }

              }
        });

});
