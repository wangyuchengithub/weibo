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
        <!--左侧导航-->        
        <div class="col-md-3 col-sm-12 col-xs-12 col-lg-3">
            <div class="panel panel-default" >
                <div class="panel-body">
                    <div align="center">
                        <img src="
                            <?php if($userMainInfo["face180"]): ?>/weibo/<?php echo ($userMainInfo["face180"]); ?>
                            <?php else: ?>
                                /weibo/Public/Uploadify/noface.gif<?php endif; ?>" width="180"  class="img-thumbnail" id="myface" >
                    </div>

                    <div class="caption role" align="center">
                        <h3><?php echo ($userMainInfo["username"]); ?></h3>
                        <p><a href="<?php echo U('Home/UserSetting/index');?>">@<?php echo ($userAccount); ?></a></p>
                        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6" >
                            <h5>推文</h5>
                            <p><span class="label label-default">0</span></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6" >
                            <h5>正在关注</h5>
                            <p><span class="label label-default">0</span></p>
                        </div>                       
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- 右侧内容 -->
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" >
        <div class="list-group">
            <div class="list-group-item newTweet">
                <!--<input type="text" class="form-control" id="fakePost" placeholder="有什么新鲜事？">-->
                <form action="<?php echo U('Home/Index/sendBlog');?>" method="post" id="realPost" >
                    <textarea name="content" id="" cols="20"  class="form-control" placeholder="有什么新鲜事？"></textarea>
                    <!-- 微博配图隐藏域 -->
                    <input type="hidden" name="weiboImgPath" id="weiboImgPath" value=""/>
                    <!--按钮工具栏组件-->
                    <div class="btn-toolbar" role="toolbar" >
                        <div  style="float: left;text-align: center" align="center">
                            <span class="tweetCounter">140</span>
                        </div>
                        <div class="btn-group" style="float:right">
                            <!--<a class="btn btn-default addSticker">添加表情</a>-->
                            <!--&lt;!&ndash;添加表情DIV&ndash;&gt;-->
                            <!--<div id="stickerDiv" width="200" height="100" style="position: absolute;top:35px;left:10px; display:none;z-index: 99999;" >-->
                                <!--<div class="panel panel-default">-->
                                    <!--<div class="panel-body">-->
                                        <!--<table>-->
                                        <!--<tr>-->
                                            <!--<td>11</td>                                           -->
                                            <!--<td>22</td>                                           -->
                                        <!--</tr>                                              -->
                                        <!--</table>-->

                                    <!--</div>-->
                                <!--</div>-->
                            <!--</div>-->

                            <a class="btn btn-default addPic">添加图片</a>
                            <!--添加配图DIV-->
                            <div id="picDiv"  style="width:200px; position: absolute;top:35px;left:10px; display:none;z-index: 99999;" >
                                <div class="panel panel-default" >
                                    <div class="panel-body" >
                                        <div class="" align="center">                                         
                                            <img src="" width="150" id="weiboPicPreview">
                                            <div class="caption">
                                                <input type="file" name="weiboPicUp" id="weiboPicUp" >                                                   
                                            </div>                                     
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                           <button class="btn btn-success" type="submit" >发推</button>
                        </div>
                    </div>
                </form>
            </div>
            



            <?php if(is_array($weiboContent)): $i = 0; $__LIST__ = $weiboContent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['isturn']): ?><div class="list-group-item tweet" tweetId="<?php echo ($vo["id"]); ?>" >
                    <div class="media" >

                        <div class="media-left" style="width: 85px">
                            <a  href="javascript:;" >
                            <img src="
                            <?php if($vo["face"]): ?>/weibo/<?php echo ($vo["face"]); ?>
                            <?php else: ?>
                                /weibo/Public/Uploadify/noface.gif<?php endif; ?>
                            " width="80" height="80" class="img-thumbnail"/>                            
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="/weibo/index.php/<?php echo ($vo["uid"]); ?>"><span class="username"><?php echo ($vo['username']); ?></span></a>&nbsp;&nbsp;
                            <small><?php echo (timeFormat($vo['time'])); ?></small>&nbsp;&nbsp;
                            <small>
                                <a href="javascript:" class="detailTweet" style="display: none" wid="<?php echo ($vo["id"]); ?>">查看更多</a>
                            </small>&nbsp;&nbsp;
                            <p class="content"><?php echo (replaceContent($vo['content'])); ?></p>
                        </div>
                        <div class="panel panel-default" style="margin-top: 2px;">
                            <div  class="tweet panel-body" tweetId="<?php echo ($vo["originalTweet"]["id"]); ?>">
                                <a href="/weibo/index.php/<?php echo ($vo["originalTweet"]["uid"]); ?>"><span class="oriUsername"><?php echo ($vo['originalTweet']['username']); ?></span></a>&nbsp;&nbsp;
                                <small><?php echo (timeFormat($vo['originalTweet']['time'])); ?></small>&nbsp;&nbsp;
                                <small><a href="javascript:" class="detailTweet" style="display: none" wid="<?php echo ($vo["originalTweet"]["id"]); ?>" >查看更多</a></small>&nbsp;&nbsp;
                                <p class="oriContent"><?php echo (replaceContent($vo['originalTweet']['content'])); ?></p>
                                <?php if($vo["originalTweet"]["thumbpic"]): ?><div>
                                        <img src='/weibo/<?php echo ($vo["originalTweet"]["thumbpic"]); ?>' alt="微博配图" class="img-thumbnail">
                                    </div>                         
                                <?php else: endif; ?>

                            </div>
                                          
                        </div>                                 
                    </div>
                    <div align="right">
                        <a href="javascript:" class="turnBtn" oriWid="<?php echo ($vo["originalTweet"]["id"]); ?>" title="转发"><span class="glyphicon glyphicon-share-alt">&nbsp;<?php echo ($vo["turn"]); ?></span></a>&nbsp;
                        <a href="javascript:" class="commentBtn" wid="<?php echo ($vo["id"]); ?>" title="评论"><span class="glyphicon glyphicon-pencil">&nbsp;<?php echo ($vo["comment"]); ?></span></a>&nbsp;
                         <span class="glyphicon glyphicon-heart">&nbsp;0</span>&nbsp;
                    </div> 
                </div>
                <!--<div class="list-group-item loadingGif" align="center" style="display: none;">-->
                    <!--<img src="/weibo/Public/image/loading.gif" width="100">-->
                <!--</div>-->
                <div class="list-group-item" style="display: none;background-color: #d9d9d9;">

                        <textarea name="commentContent" id="commentContent" class="form-control"></textarea>
                        <input type="hidden" value="" name="wid">
                        <button class="btn btn-primary commentSubmit">评论</button>

                    
                </div>                
                <div class="list-group-item commentContainer" style="display: none;background-color: #f5f8fa;">
                    <ul class="list-group">

                    </ul>
                </div>
               


            <?php else: ?>


                <div class="list-group-item tweet" tweetId="<?php echo ($vo["id"]); ?>">
                    <div class="media" >
                        <div class="media-left" style="width: 85px">
                            <a  href="javascript:;" >
                            <img src="
                            <?php if($vo["face"]): ?>/weibo/<?php echo ($vo["face"]); ?>
                            <?php else: ?>
                                /weibo/Public/Uploadify/noface.gif<?php endif; ?>
                            " width="80" height="80" class="img-thumbnail"/>                            
                            </a>
                        </div>
                        
                        <div class="media-body">
                            <a href="/weibo/index.php/<?php echo ($vo["uid"]); ?>"><span class="oriUsername"><?php echo ($vo["username"]); ?></span></a>&nbsp;&nbsp;
                            <small><?php echo (timeFormat($vo["time"])); ?></small>&nbsp;&nbsp;
                            <small>
                                <a href="javascript:" class="detailTweet" style="display: none" wid="<?php echo ($vo["id"]); ?>">查看更多</a>
                            </small>&nbsp;&nbsp;

                            <p class="oriContent"><?php echo (replaceContent($vo["content"])); ?></p>
                            <?php if($vo["thumbpic"]): ?><div>
                                    <img src="/weibo/<?php echo ($vo["thumbpic"]); ?>" alt="微博配图" class="img-thumbnail">
                                </div>                         
                            <?php else: endif; ?>
                        </div>
                    </div>
                    <div align="right">
                        
                        <a href="javascript:" class="turnBtn" oriWid="<?php echo ($vo["id"]); ?>" firstTurn=on title="转发"><span class="glyphicon glyphicon-share-alt">&nbsp;<?php echo ($vo["turn"]); ?></span></a>&nbsp;
                        <a href="javascript:" class="commentBtn" wid="<?php echo ($vo["id"]); ?>" title="评论"><span class="glyphicon glyphicon-pencil">&nbsp;<?php echo ($vo["comment"]); ?></span></a>&nbsp;
                        <span class="glyphicon glyphicon-heart">&nbsp;0</span>&nbsp;
                    </div>                             
                </div>
                <!--<div class="list-group-item loadingGif" align="center" style="display: none;">-->
                    <!--<img src="/weibo/Public/image/loading.gif" width="100">-->
                <!--</div>-->
                <div class="list-group-item" style="display: none;background-color: #d9d9d9;">
                        <textarea name="commentContent" id="commentContent" class="form-control"></textarea>
                        <input type="hidden" value="" name="wid">
                        <button class="btn btn-primary commentSubmit">评论</button>
                    
                </div>                
                <div class="list-group-item commentContainer" style="display: none;background-color: #f5f8fa;">
                    <ul class="list-group">

                    </ul>
                </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </div>
        </div>
    </div>
</div>







<!-- 转发模态框 -->
<div class="modal fade" id="turnModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">转发推特</h4>
            </div>
            <form action="<?php echo U('Home/Index/turnBlog');?>" method="post">
                <div class="modal-body">
                    <div class="well well-sm">
                        <span class="oriTweetContent"></span>
                    </div>
                    <div class="form-group">
                        <textarea name="turnContent" id="turnContent" class="form-control"></textarea>
                        <div class="turnCommentOriCheck">
                            <input type="checkbox" name="turnCommentOri" class="turnCommentOri">
                            <span id="atOriWho"></span>
                        </div>
                        <div class="turnCommentCheck" style="display: none;">
                            <input type="checkbox" name="turnComment" class="turnComment">
                            <span id="atWho"></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" id="oriWid" name="oriWid">
                    <input type="hidden" value="" id="secWid" name="secWid">
                    <button type="submit" class="btn btn-primary">转推</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
<!-- 转发模态框 -->

<!-- 评论模态框 -->
<!-- <div class="modal fade" id="commentModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">发表评论</h4>
            </div>
            <form action="<?php echo U('Home/Index/comment');?>" method="post">
                <div class="modal-body">
                    <div class="well well-sm">
                        <span class="commentWhat"></span>                    
                    </div>
                    <div class="form-group">
                        <textarea name="commentContent" id="commentContent" class="form-control"></textarea>
                        
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" id="wid" name="wid">
                    <button type="submit" class="btn btn-primary">评论</button>
                </div>
            </form>
            
        </div>
    </div>
</div> -->
<!-- 评论模态框 -->

<!-- 推文详情模态框 -->

<!-- <div class="modal fade" id="tweetModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px">                
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button> 
                <h5>原推  </h5> 
            </div>
                <div class="list-group-item">
                    <div class="media" >
                        <a class="media-left" href="#">
                            <img  width="80" height="80" class="detailFace">                        
                            
                        </a>
                        <div class="media-body">
                            <span class="detailUname"></span>&nbsp;&nbsp;
                            <small class="detailTime"></small>&nbsp;&nbsp;
                        

                            <p class="detailContent"></p>                                  
                            <div>
                                <img class="detailImg">    
                            </div>
                        </div>
                    </div>
                    <div align="right" class="detailLink">
                        
                        <a href="#" class="turnBtn" tid="<?php echo ($vo["id"]); ?>">转发（<?php echo ($vo["turn"]); ?>）</a> 
                        <a href="#" class="commentBtn" wid="<?php echo ($vo["id"]); ?>">评论（<?php echo ($vo["comment"]); ?>）</a>
                         点赞（0）
                    </div>                             
                </div>                
            
        </div>
    </div>
</div> -->
<!-- 推文详情模态框 -->

<!-- 推文详情模态框(带转发) -->

<!-- <div class="modal fade" id="turnTweetModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px">         
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5>转发</h5>
            </div>
                <div class="list-group-item tweet" tweetId="<?php echo ($vo["id"]); ?>" >
                    <div class="media" >
                        <a class="media-left" href="#">
                            <img width="80" height="80" class="detailFace">                        
                            
                        </a>
                        <div class="media-body">
                            <span class="detailUname"></span>&nbsp;&nbsp;
                            <small class="detailTime"></small>&nbsp;&nbsp;
                            
                            <p class="detailContent"></p>  
                        </div>
                        <div class="panel panel-default" style="margin-top: 2px;">
                            <div  class="tweet panel-body" tweetId="<?php echo ($vo["originalTweet"]["id"]); ?>">
                                <span class="detailOriUname"></span>&nbsp;&nbsp;
                                <small class="detailOriTime"></small>&nbsp;&nbsp;
                                
                                <p class="detailOriContent"></p>
                                  
                                    <div>
                                        <img class="detailOriImg">    
                                    </div>                         
               

                            </div>
                                          
                        </div>                                 
                    </div>
                    <div align="right" class="detailLink">
                          
                        <a href="#" class="turnBtn" tid="<?php echo ($vo["id"]); ?>" turnStyle="1">转发（<?php echo ($vo["turn"]); ?>）</a> 评论（0） 点赞（0）
                    </div> 
                </div>                
            
        </div>
    </div>
</div> -->
<!-- 推文详情模态框(带转发) -->



<!--登入模态框-->
<!--         <form role="form" id="loginForm" action="<?php echo U('Index/Login');?>" method="post">
    <div class="modal fade" id="loginModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">登入</h4>
                </div>


                <div class="modal-body">

                    <div class="form-group">
                        <label for="account">账号</label>
                        <input  type="text" name="account" id="account" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="password">密码</label>
                        <input type="password" name="password" id="password" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="autologin">
                            <input type="checkbox" id="autologin" name="autoCheck"> 记住账号
                        </label>
                    </div>


                </div>
                <div class="modal-footer">
                    <a href="#" >忘记密码？ </a>
                    <a href="<?php echo U('Register/Index');?>" >注册</a>
                    <button type="submit" class="btn btn-primary">登入</button>

                </div>


            </div>
        </div>
    </div>
</form> -->
<!--登入模态框-->

</body>

</html>