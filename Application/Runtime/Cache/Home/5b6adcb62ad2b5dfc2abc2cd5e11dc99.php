<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>系统登录</title>
        <link href="/hg/Public/css/login.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/hg/Public/js/jquery1.42.min.js"></script>
        <script type="text/javascript" src="/hg/Public/js/jquery.SuperSlide.js"></script>
        <script src="/hg/Public/js/jquery-1.7.1.js" type="text/javascript"></script>
    </head>

    <body style="height:100%">
        <div class="header">
            <div class="headera">
                <div style="width: 1004px;margin: 0 auto;">
                    <img alt="logo" src="./Public/img/logo.jpg">
                </div>
            </div>
        </div>

        <div class="banner">
            <div class="bak">
            <div style="margin-left:70px;float:left">
                <img width="560px" height="460px"  alt="logo" src="./Public/img/theme.png">
            </div>
                <div class="login-aside">
                    <div id="o-box-up"></div>
                    <div id="o-box-down"  style="table-layout:fixed;">
                        <div class="error-box"></div>
                        <form class="registerform" method="post" action="<?php echo U('Login/login');?>">
                            <div class="fm-item">
                                <label for="logonId" class="form-label">请输入账号：</label>
                                <input type="text" maxlength="100" id="username" class="i-text" name="username">
                                <div class="ui-form-explain"></div>
                            </div>
                            <div class="fm-item">
                                <label for="logonId" class="form-label">登陆密码：</label>
                                <input type="password"  maxlength="100" id="password" class="i-text" name="password">
                                <div class="ui-form-explain"></div>
                            </div>
                          <br>
                            <div class="fm-item">
                                <label for="logonId" class="form-label"></label>
                                <input type="submit" value="" tabindex="4" id="send-btn" class="btn-login">
                                <div class="ui-form-explain"></div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div style="width:300px;margin-left:300px">
            <p>www.cd12360.com All rigths reserved.</p>
            <p>版权所有:中华人民共和国成都海关</p><br>
        </div>
    </body>
</html>