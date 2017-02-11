$(function () {
    $(document).ready(function () {
        // 验证表单
        // $('#userInfoSet').bootstrapValidator({
        //     message: 'This value is not valid',
        //     feedbackIcons: {
        //         valid: 'glyphicon glyphicon-ok',
        //         invalid: 'glyphicon glyphicon-remove',
        //         validating: 'glyphicon glyphicon-refresh'
        //     },
        //     fields:{
        //         username:{
        //             validators:{
        //                 notEmpty:{
        //                     message:'昵称不得为空'
        //                 }

        //             }
        //         },
        //         truename:{
        //             validators:{
        //                 stringLength:{                            
        //                     max:6,
        //                     message:'长度在2~6个字符之间'
        //                 }
        //             }
        //         },
        //         intro:{
        //             validators:{
        //                 notEmpty:{
        //                     message:'密码不得为空'
        //                 }
        //             }
        //         }
        //     }
        // });
        // 修复bootstrap validator重复向服务端提交bug
        // $form.on('success.form.bv', function(e) {
        //     // Prevent form submission
        //     e.preventDefault();
        // });

        // $('#loginBtn').click(function() {
        //     $('#loginForm').bootstrapValidator('validate');
        // });


        $('#constellation').val(myconstellation);
        // alert(uploadUrl);
        $('#face').uploadify({
            // auto : false,
            swf: PUBLIC + '/Uploadify/uploadify.swf',
            uploader: facePreview,
            width: 100,
            height: 50,
            // buttonImage: ...
            fileTypeDesc: 'Image file',
            fileTypeExts: '*.jpeg; *.png; *.jpg; ',  //选择图片类型，以分号隔开
            formData: {'session_id': sid},  //将session的id赋值
            multi: false,
            onUploadSuccess: function (file, data, response) {
                eval('var data = ' + data);
                if (data.msg) {
                    alert('上传文件大小不得超过2M');
                } else {
                    // alert(data.path);
                    $('#faceImg').attr('src', ROOT + data.path);
                    $('#imgPath').attr('value', data.path);
                }
            }

        });


    });
});