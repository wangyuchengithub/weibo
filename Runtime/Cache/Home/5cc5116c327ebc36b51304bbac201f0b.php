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
                <img class="navbar-brand logo" href="/weibo/index.php" src="/weibo/Public/image/logo.png" width="50"></img>
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
    <div class="row">
        111
    </div>
</div>

</body>

</html>