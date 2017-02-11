$(document).ready(function () {

    // 阻止空白内容搜索
    $("#searchBtn").click(function (check) {
        var val = $("#searching").val().trim();
        if (val == "") {

            $("#searching").focus();
            check.preventDefault();//此处阻止提交表单
        }
    });

    var turnModal=$('#turnModal');
    //  转发模态框初始化
    turnModal.modal({
        keyboard: false,
        show: false
    });
    turnModal.on(
        'shown.bs.modal', function (e) {
            $("#turnContent").focus();
        }
    );
    turnModal.on(
        'hidden.bs.modal',function(){
            $('.turnCommentOri').attr('checked',false);
            $('.turnComment').attr('checked',false);
        }
    );
    $('.turnBtn').on('click', function (event) {
        var oriWid = $(this).attr('oriWid');
        var temp = $(this).parent().prev();
        var oriUsername = temp.find('.oriUsername').text();
        var oriContent = temp.find('.oriContent').text();
        var turnCommentCheck=$('.turnCommentCheck');
        var turnContent=$('#turnContent');

// =============转推公共部分=====//
        //清空转推输入框
        turnContent.val('');
        //将原推作者名称付给checkbox
        $('#atOriWho').text('同时评论原推 @'+oriUsername);
        // 将原推内容放入well中预览
        $('.oriTweetContent').text('@' + oriUsername + ':' + oriContent);
        //将原推ID付给隐藏域oriWid
        $('#oriWid').attr('value',oriWid);
// =============转推公共部分=====//


        if ($(this).attr('firstTurn')){
            // ======首次转发======//
            //首次转发隐藏评论原推checkbox
            turnCommentCheck.hide();
        }else{
            // ======二次/多次转发======//
            // 将当前转发的作者与内容付给变量
            var username=temp.find('.username').text();
            var content=temp.find('.content').text();
            // 将之前的转推内容置入输入框
            turnContent.val('//@'+username+' :'+content);
            //二次转发展示评论当前作者checkbox
            turnCommentCheck.show();
            //将当前作者名称付给checkbox
            $('#atWho').text('同时评论 @'+username);
            //将当前推ID付给隐藏域secWid
            var secWid=$(this).next().attr('wid');
            $('#secWid').attr('value',secWid);

        }

        $('#turnModal').modal('show');
        event.stopPropagation();
    });

    // 发推上传图片div
    // $("#picDiv").hide();
    $('.addSticker').click(function () {
        $('#stickerDiv').toggle();
    });

    $('.addPic').click(function () {
        $('#picDiv').toggle();
    });


    $('#weiboPicUp').uploadify({
        // auto : false,
        swf: PUBLIC + '/Uploadify/uploadify.swf',
        uploader: weiboPicPreview,
        width: 70,
        height: 30,
        buttonText: '选择图片',
        // buttonImage: ...
        fileTypeDesc: 'Image file',
        fileTypeExts: '*.jpeg; *.png; *.jpg; *.gif;',  //选择图片类型，以分号隔开
        formData: {'session_id': sid},  //将session的id赋值
        multi: false,
        onUploadSuccess: function (file, data, response) {
            eval('var data = ' + data);
            if (data.msg) {
                alert('上传文件大小不得超过2M');
            } else {
                // alert(data.path);
                $('#weiboPicPreview').attr('src', ROOT + data.path);
                $('#weiboImgPath').attr('value', data.path);
            }
        }
    });

    // 推文hover效果
    $('.tweet').hover(function (event) {
            $(this).css('background-color', '#f5f8fa');
            $(this).find('.detailTweet:first').show();
            event.stopPropagation();
        }, function (event) {
            $(this).css('background-color', '#fff');
            $(this).find('.detailTweet:first').hide();
            event.stopPropagation();
        }
    );

    //转推内容hover效果

    //异步获取评论
    $('.commentBtn').on('click', function () {
        var wid = $(this).attr('wid');
        // var loadingGif = $(this).parent().parent().next();
        var loadingGif = $('.loadingGif');
        var logoPic=$('.logoPic');
        var commentArea = $(this).parent().parent().next();
        var commentContainer = $(this).parent().parent().next().next();
        commentArea.find('input[name=wid]').attr('value',wid);
        if (commentArea.css('display') == 'none') {
            $.ajax({
                url: getCommentUrl,
                data: {'wid': wid},
                type: 'post',
                dataType: 'json',
                beforeSend: function () {
                    loadingGif.show();
                    logoPic.hide();
                },
                success: function (result) {
                    $.each(result, function (index, obj) {
                        if (obj.face) {
                            var face = ROOT + '/'+obj.face;
                        } else {
                            var face = PUBLIC + "/Uploadify/noface.gif";
                        }
                        commentContainer.find('.list-group').
                        append("<li class='list-group-item'><img src=" + face + "  width='50' class='img-thumbnail'><span>" + obj.username + "&nbsp;:&nbsp;</span><span>" + obj.content + "</span></li>");
                    });
                    if (result.length >= 5) {
                        commentContainer.find('.list-group').append("<li class='list-group-item'><span>查看更多评论</span></li>");
                    }
                    // commentContainer.find('.list-group').
                    // append("<li class='list-group-item'><span>暂无评论</span></li>");   

                    loadingGif.hide();
                    logoPic.show();
                    commentArea.slideDown();
                    commentContainer.slideDown();
                }

            });
        } else {
            commentArea.slideUp();
            commentArea.find('#commentContent').val('');
            commentContainer.find('.list-group').empty();
            commentContainer.slideUp();

        }

    });

    // 异步发送评论
    $('.commentSubmit').click(function(event){
        var commentArea=$(this).prev().prev();
        var listGroup=$(this).parent().next().find('.list-group');
        var wid=$(this).prev().attr('value');
        var commentVal=commentArea.val();
        var loadingGif = $('.loadingGif');
        var logoPic=$('.logoPic');
        if(commentVal.trim() ==""){
            commentArea.focus();
            event.preventDefault();
        }else{
            $.ajax({
                url:sendCommentUrl,
                data:{'commentVal':commentVal,'wid':wid},
                type:'POST',
                dataType:'json',
                beforeSend:function(){
                    loadingGif.show();
                    logoPic.hide();
                },
                success:function(data){
                    if(data.stats==1){
                        var response="<li class='list-group-item'><img src=" + ROOT+"/"+data.myComment.face + "  width='50' class='img-thumbnail'><span>" + data.myComment.username + "&nbsp;:&nbsp;</span><span>" + data.myComment.content + "</span></li>";
                        commentArea.val('');
                        $(response).hide().prependTo(listGroup).slideDown();

                    }
                    loadingGif.hide();
                    logoPic.show();
                }
            });
        }



    });

    //待做
    // $('#fakePost').click(function(){
    //     var realPost=$('#realPost');
    //     $(this).hide();
    //     realPost.show();
    //     realPost.find('textarea').focus();
    // });

    var getLength = (function(){
        var trim = function(h) {
            try {
                return h.replace(/^\s+|\s+$/g, "")
            } catch(j) {
                return h
            }
        };
        var byteLength = function(b) {
            if (typeof b == "undefined") {
                return 0
            }
            var a = b.match(/[^\x00-\x80]/g);
            return (b.length + (!a ? 0 : a.length))
        };
        return function(q, g) {
            g = g || {};
            g.max = g.max || 140;
            g.min = g.min || 41;
            g.surl = g.surl || 20;
            var p = trim(q).length;
            if (p > 0) {
                var j = g.min,
                    s = g.max,
                    b = g.surl,
                    n = q;
                var r = q.match(/(http|https):\/\/[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)+([-A-Z0-9a-z\$\.\+\!\_\*\(\)\/\,\:;@&=\?~#%]*)*/gi) || [];
                var h = 0;
                for (var m = 0,
                         p = r.length; m < p; m++) {
                    var o = byteLength(r[m]);
                    if (/^(http:\/\/t.cn)/.test(r[m])) {
                        continue
                    } else {
                        if (/^(http:\/\/)+(weibo.com|weibo.cn)/.test(r[m])) {
                            h += o <= j ? o: (o <= s ? b: (o - s + b))
                        } else {
                            h += o <= s ? b: (o - s + b)
                        }
                    }
                    n = n.replace(r[m], "")
                }
                return Math.ceil((h + byteLength(n)) / 2)
            } else {
                return 0
            }
        }
    })();

});