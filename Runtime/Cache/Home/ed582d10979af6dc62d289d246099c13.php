<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
    <title>weibo</title>
    <link rel="stylesheet" href="/weibo/Public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/weibo/Public/css/bootstrapValidator.min.css" />
    <link rel="stylesheet" href="/weibo/Public/css/index.css" />
    <link rel="stylesheet" href="/weibo/Public/css/search.css" />
    <link rel="stylesheet" href="/weibo/Public/css/usersetting.css" />
    <link rel="stylesheet" href="/weibo/Public/Uploadify/uploadify.css" />
    <script src="/weibo/Public/js/jquery.min.js"></script>
    <script src="/weibo/Public/js/bootstrap.min.js"></script>
    <script src="/weibo/Public/js/bootstrapValidator.min.js"></script>
    <script src="/weibo/Public/Uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript">
        var isLogin = "<?php echo ($isLogin); ?>";
        var myconstellation="<?php echo ($userinfo["constellation"]); ?>";
        var PUBLIC="/weibo/Public";
        var ROOT="/weibo";
//        var tempRoot="/weibo/index.php";
        var facePreview='<?php echo U("Home/UserSetting/facePreview");?>';
        var weiboPicPreview='<?php echo U("Home/Index/weiboPicPreview");?>';
        var sid="<?php echo session_id();?>";
        var addGroupUrl="<?php echo U('Home/Search/addGroup');?>";
        var getGroupUrl="<?php echo U('Home/Search/getGroup');?>";
        var followUrl="<?php echo U('Home/Search/follow');?>";
        var removFollowUrl="<?php echo U('Home/Search/removFollow');?>";
        var getCommentUrl="<?php echo U('Home/Index/getComment');?>";
        var sendCommentUrl="<?php echo U('Home/Index/sendComment');?>"
    </script>
    <script src="/weibo/Public/js/index.js"></script>
    <script src="/weibo/Public/js/usersetting.js"></script>
    <script src="/weibo/Public/js/search.js"></script>



</head>

<body >
    <!--顶部导航-->
    <nav class="navbar  navbar-default navbar-fixed-top ">
        <div class="container">
            <div class="navbar-header ">
                <div class="logo">
                    <img class="logoPic" src="/weibo/Public/image/logo.png" >
                    <img class="loadingGif" src="/weibo/Public/image/loading3.gif" style="display: none    ">
                </div>
                <!--<span class="navbar-brand logo" href="/weibo/index.php" >LOGO</span>-->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navcol">
                    <span class="sr-only">切换导航</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>




            </div>
            <div class="collapse navbar-collapse" id="navcol">
                <ul class="nav navbar-nav navbar-left navcol" >
                    <li class="active">
                        <a href="/weibo/index.php">主页</a>
                    </li>
                    <li>
                        <a href="#" >通知</a>
                    </li>
                    <li>
                        <a href="#" >私信</a>
                    </li>
                </ul>
                <!--<div class="nav navbar-nav navbar-center" style="margin-top: 0;">-->
                    <!--<li>-->
                        <!--<a class="navbar-brand" href="/weibo/index.php">Weibo</a>-->
                    <!--</li>-->

                <!--</div>-->

                <ul class="nav navbar-nav navbar-right  " >
                    <li>
                        <form action="<?php echo U('Home/Search/searchUser');?>" class="navbar-form" id='searchForm'>
                            <div class="form-group">
                                <input type="text" class="form-control" name="searching" id="searching" placeholder="找人、搜索微博" />
                            </div>
                            <button type="submit" class="btn btn-default" id="searchBtn">搜索</button>
                        </form>
                    </li>
                    <li>
                    <div class="dropdown">
                        <img src="
                        <?php if($userMainInfo["face50"]): ?>/weibo/<?php echo ($userMainInfo["face50"]); ?>
                        <?php else: ?>
                            /weibo/Public/Uploadify/noface.gif<?php endif; ?>
                                "
                                href="#" width="40" height="40" class="dropdown-toggle img-thumbnail" data-toggle="dropdown" style="margin-top: 5px;" >
                        <ul class="dropdown-menu " role="menu">
                            <li><a href="<?php echo U('Home/UserSetting/index');?>">账号设置</a></li>
                            <li><a href="#">模板设置</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo U('Home/Index/logout');?>">退出</a></li>
                        </ul>
                    </div>
                    </li>
                    <!--<li>-->
                        <!--<button  class="btn btn-primary">发推</button>-->
                    <!--</li>-->

                </ul>


            </div>
        </div>
    </nav>

<div class="container maincontent">
    <div class="page-header">
        <h2><small>搜索：</small> <?php echo ($keyword); ?></h2>

    </div>
    <ul class="nav nav-pills nav-justified" role="tablist">
        <li role="presentation" class="active"><a href="#">搜用户</a></li>
        <li role="presentation" class=""><a href="#">搜推文</a></li>
        <li role="presentation" class="disabled"><a href="#">Disabled link</a></li>
    </ul>
    <div class="row">

        <!--分组-->
        <div class="hidden-sm hidden-xs col-lg-2 col-md-2" style="margin-top: 10px;">
            <button class="btn btn-default addGroupBtn"  >添加分组</button>
            <ul class="list-group">
                <a class="list-group-item">
                    同事<span class="badge">14</span>
                </a>
                <a class="list-group-item">
                    同学<span class="badge">14</span>
                </a>
                <a class="list-group-item">
                    亲人<span class="badge">14</span>
                </a>
            </ul>
        </div>


        <!--搜索内容-->
        <div class="col-lg-10 col-md-10 ">
            <div class="panel panel-default " style="margin-top: 10px; ">
                <div class="panel-body">
                    <nav style="margin: 0 auto">
                        <?php echo ($show); ?>
                    </nav>
                    <div class="row">
                        <?php if(is_array($searchList)): $i = 0; $__LIST__ = $searchList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="thumbnail">
                                    <img src="
                                    <?php if($vo["face80"]): ?>/weibo/<?php echo ($vo["face80"]); ?>
                                    <?php else: ?>
                                    /weibo/Public/Uploadify/noface.gif<?php endif; ?>" width="80" height="80">
                                    <div class="caption" style="text-align: center; " >
                                        <h5><?php echo ($vo["username"]); ?></h5>
                                        <div style="height: 50px; overflow: hidden;margin: 3px"><p><?php echo ($vo["intro"]); ?></p></div>
                                        <p>
                                            <?php if($vo["followStats"] == 2): ?><button href="#" class="btn btn-default mutualBtn" role="button" uid="<?php echo ($vo["uid"]); ?>">互相关注</button>
                                                <?php elseif($vo["followStats"] == 1): ?>
                                                <button href="#" class="btn btn-default followedBtn" role="button" uid="<?php echo ($vo["uid"]); ?>">已关注</button>
                                                <?php else: ?>
                                                <button href="#" class="btn btn-primary followBtn" role="button"  uid="<?php echo ($vo["uid"]); ?>">加关注</button><?php endif; ?>
                                            <!-- <a href="#" class="btn btn-primary" role="button">加关注</a> -->
                                        </p>
                                    </div>
                                </div>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
            </div>
        </div>


    </div>




</div>

<!--关注选择分组模态框-->
<div class="modal fade" id="selectGroupModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">将用户加入分组</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="selectGroup">选择分组</label>
                    <!--<input  type="text" name="account" id="account" class="form-control"/>-->
                    <select name="selectGroup" id="selectGroup" class="form-control">
                        <option value="0" id="defaultGroup">默认分组</option>
                        <?php if(is_array($userGroup)): $i = 0; $__LIST__ = $userGroup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>  

                    </select>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control addGroupName" >
                        <span class="input-group-btn">
                            <button class="btn btn-default addGroup" type="button">新增分组</button>
                        </span>
                    </div><!-- /input-group -->
                </div>
            </div>
            <div class="modal-footer">
                <button  class="btn btn-primary" id="followSubmit">确认</button>
                <input type="hidden" name="userid" />
            </div>
        </div>
    </div>
</div>
<!--关注选择分组模态框-->


<div class="modal fade" id="removFollowModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">是否不再关注：</h4>
            </div>
            <div class="modal-body">
                
                
            </div>
            <div class="modal-footer">
                <button  class="btn btn-primary" id="followDelSubmit">确认</button>
                <input type="hidden" name="userid" />
            </div>
        </div>
    </div>
</div>




</body>

</html>