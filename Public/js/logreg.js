$(function () {

    //点击刷新验证码


    //jQuery Validate 表单验证

    /**
     * 添加验证方法
     * 以字母开头，5-17 字母、数字、下划线"_"
     */
    // jQuery.validator.addMethod("user", function(value, element) {
    //     var tel = /^[a-zA-Z][\w]{4,16}$/;
    //     return this.optional(element) || (tel.test(value));
    // }, "以字母开头，5-17 字母、数字、下划线'_'");

// jQuery validata 验证插件写法


    // $('form[name=register]').validate({
    // 	errorElement : 'span',
    // 	success : function (label) {
    // 		label.addClass('success');
    // 	},
    // 	rules : {
    // 		account : {
    // 			required : true,
    // 			user : true,
    // 			remote : {
    // 				url : checkAccount,
    // 				type : 'post',
    // 				dataType : 'json',
    // 				data : {
    // 					account : function () {
    // 						return $('#account').val();
    // 					}
    // 				}
    // 			}
    // 		},
    // 		pwd : {
    // 			required : true,
    // 			user : true
    // 		},
    // 		pwded : {
    // 			required : true,
    // 			equalTo : "#pwd"
    // 		},
    // 		uname : {
    // 			required : true,
    // 			rangelength : [2,10],
    // 			remote : {
    // 				url : checkUname,
    // 				type : 'post',
    // 				dataType : 'json',
    // 				data : {
    // 					uname : function () {
    // 						return $('#uname').val();
    // 					}
    // 				}
    // 			}
    // 		},
    // 		verify : {
    // 			required : true,
    // 			remote : {
    // 				url : checkVerify,
    // 				type : 'post',
    // 				dataType : 'json',
    // 				data : {
    // 					verify : function () {
    // 						return $('#verify').val();
    // 					}
    // 				}
    // 			}
    // 		}
    // 	},
    // 	messages : {
    // 		account : {
    // 			required : '账号不能为空',
    // 			remote : '账号已存在'
    // 		},
    // 		pwd : {
    // 			required : '密码不能为空'
    // 		},
    // 		pwded : {
    // 			required : '请确认密码',
    // 			equalTo : '两次密码不一致'
    // 		},
    // 		uname : {
    // 			required : '请填写您的昵称',
    // 			rangelength : '昵称在2-10个字之间',
    // 			remote : '昵称已存在'
    // 		},
    // 		verify : {
    // 			required : ' ',
    // 			remote : ' '
    // 		}
    // 	}
    // });

    $(document).ready(function () {
        // 设置图片地址变化
        var verifyUrl = $('#verify-img').attr('src');
        $('#verify-img').click(function () {
            $(this).attr('src', verifyUrl + '?' + Math.random());
            $('#verify').val('');
        });

        // 注册表单验证
        $('#regForm').bootstrapValidator({
            // message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                account: {
                    validators: {
                        notEmpty: {
                            message: '账号不得为空！'
                        },
                        remote: {
                            url: checkAccount,

                            dataType: 'json',
                            delay: 20000
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: '账号不得为空！'
                        }
                    }
                },
                passworded: {
                    validators: {
                        notEmpty: {
                            message: '请重新输入密码！'
                        },
                        identical: {
                            field: 'password',
                            message: '密码不一致！'
                        }
                    }
                },
                username: {
                    validators: {
                        notEmpty: {
                            message: '请输入昵称！'
                        },
                        remote: {
                            url: checkUsername,
                            dataType: 'json',
                            delay: 20000
                        }
                    }
                },
                verify: {
                    validators: {
                        notEmpty: {
                            message: '请输入验证码'
                        },
                        remote: {
                            url: checkVerify,
                            dataType: 'json',
                            message: '验证码错误'
                        }
                    }
                }
            }

        });
        // 登入表单验证
        $('#loginForm').bootstrapValidator({
            // message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },

            fields: {
                account: {
                    validators: {
                        notEmpty: {
                            message: '账号不得为空'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: '密码不得为空'
                        }
                    }
                }
            }
        });

        // 修复bootstrap validator重复向服务端提交bug
        // $('#loginForm').on('success.form.bv', function(e) {
        //     // Prevent form submission
        //     e.preventDefault();
        // });


        // $('#regSubmit').click(function () {
        //     $('#regForm').bootstrapValidator('validate');
        // });


    });


});