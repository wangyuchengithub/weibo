<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <title>微博-注册</title>
    <link rel="stylesheet" href="/weibo/Public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/weibo/Public/css/bootstrapValidator.min.css" />
    <script src="/weibo/Public/js/jquery.min.js"></script>
    <script src="/weibo/Public/js/bootstrap.min.js"></script>
    <script src="/weibo/Public/js/bootstrapValidator.min.js"></script>
    <script type='text/javascript'>
        var checkAccount = "<?php echo U('checkAccount');?>";
        var checkUsername = "<?php echo U('checkUsername');?>";
        var checkVerify = "<?php echo U('checkVerify');?>";
    </script>
    <script src="/weibo/Public/js/logreg.js"></script>

</head>
<body style="background: url('http://wx1.sinaimg.cn/large/68f17e01gy1fci21ac0o4j21kw11xtd1.jpg')">

<div class="container" style="margin-top: 70px;">
    <div class="row">
        <div class=" hidden-xs  col-sm-6 col-md-8">
            <p><h1>背景内容</h1></p>
            <p><h1>文字描述and so on</h1></p>

        </div>

        
        <div class="col-md-4 col-sm-6">
            <!-- 登入 -->
            <div class="panel panel-default" >
                <div class="panel-body">
                    <form action="<?php echo U('Home/LogReg/runLogin');?>" method="post" id="loginForm">
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
                        <button type="submit" class="btn btn-primary">登入</button>
                    </form>

                </div>
            </div>

            <!-- 注册 -->
            <div class="panel panel-default" >
                <div class="panel-body">
                    <form role="form" id="regForm" method="post" action="<?php echo U('Home/LogReg/runRegis');?>">
                        <p>注册一个新账户？</p>
                        <div class="form-group">
                            <label for="account">账号</label>
                            <input type="text" class="form-control" id="account" name="account" placeholder="#">
                        </div>
                        <div class="form-group">
                            <label for="password">密码</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="#">
                        </div>
                        <div class="form-group">
                            <label for="passworded">确认密码</label>
                            <input type="password" class="form-control" id="passworded" name="passworded"placeholder="#">
                        </div>
                        <div class="form-group">
                            <label for="username" >昵称</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="#">
                        </div>
                        <label for="verify">验证码</label>        
                        <div class="form-group"  >
                                                
                            <input type="text" class="form-control" id="verify" placeholder="#" name="verify"  />
                            <img src="<?php echo U('Home/LogReg/verify');?>" width='100' height='40' id='verify-img' class="img-thumbnail" />
                            
                        </div>
                        

                        <button type="submit" class="btn btn-default" id="regSubmit">提交</button>

                    </form>

                </div>
            </div>
        </div>
    </div>


</div>




</body>
</html>