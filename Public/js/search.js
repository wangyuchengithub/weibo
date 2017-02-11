$(function(){

    $(document).ready(function(){
        // 添加关注模态框
        $('#selectGroupModal').modal({
            keyboard:false,
            show:false,
        });
        $('.followBtn').click(function(){
            var uid    =    $(this).attr('uid');
            $('#selectGroupModal').modal('show');
            $('input[name=userid]').val(uid);

        });

        $('#followSubmit').click(function(){
            var gid    =    $('#selectGroup').val();
            var uid    =    $('input[name=userid]').val();
            $.post(followUrl,{'gid':gid,'uid':uid},function(data){
                if(data.newFollowed){
                    alert(data.msg);
                    parent.location.reload();
                }else{
                    alert(data.msg);
                }
            },'json');
        });
        // 添加关注模态框
        

        // 互相关注+已关注>取消关注
        $(".mutualBtn").hover(function(){
            $(this).removeClass('btn-default').addClass('btn-primary').text('取消关注');
        },function(){
            $(this).removeClass('btn-primary').addClass('btn-default').text('互相关注');
        }); 

        $(".followedBtn").hover(function(){
            $(this).removeClass('btn-default').addClass('btn-primary').text('取消关注');
        },function(){
            $(this).removeClass('btn-primary').addClass('btn-default').text('已关注');
        }); 

        $('#removFollowModal').modal({
            keyboard:false,
            show:false,
        });

        $('.mutualBtn').click(function(){
            var uid    =    $(this).attr('uid');
            $('input[name=userid]').val(uid);
            $('#removFollowModal').modal('show');
        });

        $('.followedBtn').click(function(){
            var uid    =    $(this).attr('uid');
            $('input[name=userid]').val(uid);
            $('#removFollowModal').modal('show');
        });

        $('#followDelSubmit').click(function(){
            var uid    =    $('input[name=userid]').val();
            $.post(removFollowUrl,{'uid':uid},function(data){
                if(data.deleted){
                    alert(data.msg);
                    parent.location.reload();
                }else{
                    alert(data.msg);
                }
            },'json');
        });        
        // 互相关注+已关注>取消关注






        // 关注用户时的新增分组操作
        $('.addGroup').click(function(){
            var groupName   =   $('.addGroupName').val();
            if (groupName != false){
                $.post(addGroupUrl,{'groupName':groupName},function(data){
                    if(data.stats){
                        $('.addGroupName').val(""); 
                        alert(data.msg);  
                        $('select option:last-child')
                        .after('<option value='+data.newGroup.id+'>'+data.newGroup.name+'</option>');                           
                    }
                },'json');
            }else{
                $('.addGroupName').focus();
            }

        });




    //
    // $('#addGroupModal').modal({
    //     keyboard:false,
    //     show:false,
    // });
    // $('.addGroupBtn').on('click',function(){
    //     $('#addGroupModal').modal('show');
    // });



    });
});