<?php /*a:3:{s:64:"/library/WebServer/Documents/tp6/app/admin/view/index/login.html";i:1579951299;s:65:"/library/WebServer/Documents/tp6/app/admin/view/public/_meta.html";i:1579946887;s:67:"/library/WebServer/Documents/tp6/app/admin/view/public/_footer.html";i:1579951299;}*/ ?>
﻿<!DOCTYPE HTML>
<html>
<head>
  <title>后台登录</title>
  <meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
    <script type="text/javascript" src="/lib/html5.js"></script>
    <script type="text/javascript" src="/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin.pro/css/h-ui.admin.pro.iframe.min.css" />
<link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.9/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/business/css/style.css" />
<link rel="stylesheet" type="text/css" href="/assets/css/public/tip.css" />
<!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
<![endif]-->

  <link rel="stylesheet" type="text/css" href="/assets/css/admin/login.css" />
</head>
<body >

<div class="header">
  <h1>LOGIN IN</h1>
</div>
<div class="loginWraper">
  <div id="loginform" class="loginBox">

    <form class="form form-horizontal">

      <div class="row cl">

        <label class="form-label col-xs-4"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input id="username" type="text" placeholder="用户名" class="input-text size-L">
        </div>

      </div>

      <div class="row cl">

        <label class="form-label col-xs-4"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input id="password" type="password" placeholder="密码" class="input-text size-L">
        </div>

      </div>

      <div class="row cl">

        <label class="form-label col-xs-4"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-2">
          <input id="validate" type="text" placeholder="验证码..." class="input-text size-L">
        </div>

      </div>

      <div class="row cl">

        <div class="formControls col-xs-8 col-xs-offset-4">
          <div>
            <img id="captcha" src="<?php echo captcha_src(); ?>" alt="点击更新验证码" />
          </div>
          <a href="#" id="captcha_a"class="dian">&nbsp;&nbsp;&nbsp;&nbsp;看不清?点图片或者点我</a>
        </div>

      </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      <div class="row cl" id="alert">
        <div id="remove">

        </div>
      </div>
      <br><br>

      <div class="row cl">

        <div class="formControls col-xs-8 col-xs-offset-4">&nbsp;
          <input id="login_send" type="button" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">&nbsp; &nbsp; &nbsp;
          <input type="reset" class="btn btn-default radius size-L size2" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>

      </div>

    </form>

  </div>
</div>
<div class="footer">Copyright &copy;Shane PowerBy H-ui.admin</div>
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/lib/layer/3.1.1/layer.js"></script>
<script type="text/javascript" src="/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/h-ui.admin.pro/js/h-ui.admin.pro.iframe.min.js"></script>
<!--我的assets-->
<script type="text/javascript" src="/assets/js/public/tip.js"></script>
<script type="text/javascript" src="/assets/js/admin/admin_public/admin.menu.js"></script>
<script type="text/javascript" src="/assets/js/admin/admin_public/admin.header.js"></script>
<script src="/assets/js/admin/admin_public/admin.login.ajax.js"></script>
<script src="/assets/js/admin/admin_public/reload.captcha.js"></script>
</body>
</html>