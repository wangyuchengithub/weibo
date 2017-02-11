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
    <div class="row" >
        <!-- 右侧内容 -->
        <div class="col-md-7 col-sm-7 col-xs-7">
        <div class="panel panel-default">
            <div class="panel-body">

                    <!-- 导航标签 -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#infoTab" role="tab" data-toggle="tab">基本信息</a></li>
                        <li role="presentation"><a href="#faceTab" role="tab" data-toggle="tab">修改头像</a></li>
                        <li role="presentation"><a href="#pwdTab" role="tab" data-toggle="tab">修改密码</a></li>
                    </ul>

                    <!-- 标签页内容 -->
                    <div class="tab-content">
                        <!-- 个人资料更新 -->
                        <div role="tabpanel" class="tab-pane active" id="infoTab" >

                            <form class="form-horizontal" role="form" action="<?php echo U('Home/UserSetting/infoupdate');?>" method="post" id="userInfoSet">

                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label">昵称</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="username" name="username"  value="<?php echo ($userinfo["username"]); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="truename" class="col-sm-2 control-label">真实姓名</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="truename" name="truename"  value="<?php echo ($userinfo["truename"]); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">性别</label>
                                    <div class="col-sm-10">
                                        <label class="radio-inline">
                                            <input type="radio" name="sex" id="sex1" value="男"  <?php if($userinfo["sex"]=="男"): ?>checked=true<?php endif; ?>/> 男
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="sex" id="sex2" value="女"<?php if($userinfo["sex"]=="女"): ?>checked=true<?php endif; ?>/> 女
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="location" class="col-sm-2 control-label">所在地</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="location" name="location"  value="<?php echo ($userinfo["location"]); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="constellation" class="col-sm-2 control-label">星座</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="constellation" id="constellation">
                                            <option value="">请选择</option>
                                            <option value="白羊座">白羊座</option>
                                            <option value="金牛座">金牛座</option>
                                            <option value="双子座">双子座</option>
                                            <option value="巨蟹座">巨蟹座</option>
                                            <option value="狮子座">狮子座</option>
                                            <option value="处女座">处女座</option>
                                            <option value="天秤座">天秤座</option>
                                            <option value="天蝎座">天蝎座</option>
                                            <option value="射手座">射手座</option>
                                            <option value="魔羯座">魔羯座</option>
                                            <option value="水瓶座">水瓶座</option>
                                            <option value="双鱼座">双鱼座</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="intro" class="col-sm-2 control-label">简介</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="intro" name="intro" ><?php echo ($userinfo["intro"]); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-default">保存</button>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <!-- 头像设置 -->
                        <div role="tabpanel" class="tab-pane" id="faceTab">

                            <form action="<?php echo U('Home/UserSetting/faceEdit');?>" method="post">
                                <div class="" align="center">
                                    <div >
                                        <img src="
                                            <?php if($userinfo["face180"]): ?>/weibo/<?php echo ($userinfo["face180"]); ?>
                                        <?php else: ?>
                                        /weibo/Public/Uploadify/noface.gif<?php endif; ?>
                                        "
                                         height="180" id="faceImg">
                                        <div class="caption">
                                            <p class="help-block">尽量选择方形尺寸的图片并且分辨率180*180以上为佳</p>
                                            <p class="help-block">图片将自动裁剪</p>
                                            <input type="file" name="face" id="face" >
                                            <input type="hidden" name="imgPath" id="imgPath" value=""/>
                                            <p><button href="#" type="submit" class="btn btn-default" role="button">确认上传</button></p>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <!-- 密码修改 -->
                        <div role="tabpanel" class="tab-pane" id="pwdTab">

                            <form class="form-horizontal" role="form" action="<?php echo U('Home/UserSetting/resetpwd');?>" method="post" id="pwdReset">
                                <div class="form-group">
                                    <label for="password" class="col-sm-2 control-label">旧密码</label>
                                    <div class="col-sm-3">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="resetpwd" class="col-sm-2 control-label">新密码</label>
                                    <div class="col-sm-3">
                                        <input type="password" class="form-control" id="resetpwd" name="resetpwd" placeholder="" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="resetpwd1" class="col-sm-2 control-label">确认新密码</label>
                                    <div class="col-sm-3">
                                        <input type="password" class="form-control" id="resetpwd1" name="resetpwd1" placeholder="" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-default">保存</button>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>


            </div>
         </div>
        </div>


    </div>
</div>





</body>

</html>