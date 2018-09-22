<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <title>登录商城</title>
  <link rel="stylesheet" href="/Public/Home/style/base.css" type="text/css">
  <link rel="stylesheet" href="/Public/Home/style/global.css" type="text/css">
  <link rel="stylesheet" href="/Public/Home/style/header.css" type="text/css">
  <link rel="stylesheet" href="/Public/Home/style/login.css" type="text/css">
  <link rel="stylesheet" href="/Public/Home/style/footer.css" type="text/css">
</head>
<body>
<!-- 顶部导航 start -->
<div class="topnav">
  <div class="topnav_bd w990 bc">
    <div class="topnav_left">

    </div>
    <div class="topnav_right fr">
      <ul>
        <li>您好，欢迎来到京西！[<a href="login.html">登录</a>] [<a href="register.html">免费注册</a>] </li>
        <li class="line">|</li>
        <li>我的订单</li>
        <li class="line">|</li>
        <li>客户服务</li>

      </ul>
    </div>
  </div>
</div>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 页面头部 start -->
<div class="header w990 bc mt15">
  <div class="logo w990">
    <h2 class="fl"><a href="index.html"><img src="/Public/Home/images/logo.png" alt="京西商城"></a></h2>
  </div>
</div>
<!-- 页面头部 end -->


<<!--!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>用户注册</title>
	<link rel="stylesheet" href="__Home__/style/base.css" type="text/css">
	<link rel="stylesheet" href="__Home__/style/global.css" type="text/css">
	<link rel="stylesheet" href="__Home__/style/header.css" type="text/css">
	<link rel="stylesheet" href="__Home__/style/login.css" type="text/css">
	<link rel="stylesheet" href="__Home__/style/footer.css" type="text/css">-->
	<script src="/Public/Home/js/jquery-1.8.3.min.js"></script>
</head>
<!--<body>
	&lt;!&ndash; 顶部导航 start &ndash;&gt;
	<div class="topnav">
		<div class="topnav_bd w990 bc">
			<div class="topnav_left">
				
			</div>
			<div class="topnav_right fr">
				<ul>
					<li>您好，欢迎来到京西！[<a href="login.html">登录</a>] [<a href="register.html">免费注册</a>] </li>
					<li class="line">|</li>
					<li>我的订单</li>
					<li class="line">|</li>
					<li>客户服务</li>

				</ul>
			</div>
		</div>
	</div>
	&lt;!&ndash; 顶部导航 end &ndash;&gt;
	
	<div style="clear:both;"></div>

	&lt;!&ndash; 页面头部 start &ndash;&gt;
	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="index.html"><img src="/Public/Home/images/logo.png" alt="京西商城"></a></h2>
		</div>
	</div>
	&lt;!&ndash; 页面头部 end &ndash;&gt;
	-->
	<!-- 登录主体部分start -->
	<div class="login w990 bc mt10 regist">
		<div class="login_hd">
			<h2>用户注册</h2>
			<b></b>
		</div>
		<div class="login_bd">
			<div class="login_form fl">
				<form action="" method="post">
					<ul>
						<li>
							<label for="">用户名：</label>
							<input type="text" class="txt" name="username" />
							<p>3-20位字符，可由中文、字母、数字和下划线组成</p>
						</li>
						<li>
							<label for="">密码：</label>
							<input type="password" class="txt" name="password" />
							<p>6-20位字符，可使用字母、数字和符号的组合，不建议使用纯数字、纯字母、纯符号</p>
						</li>
						<li>
							<label for="">确认密码：</label>
							<input type="password2" class="txt" name="password" />
							<p> <span>请再次输入密码</p>
						</li>
						<li>
							<label for="">验证码：</label>
							<input type="text" class="txt txt2" name="mobile" />
							<span class="sms_btn">点击发送短信验证码</span>
							<p> <span>发送短信验证码</p>
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="checkbox" class="chb" checked="checked" /> 我已阅读并同意《用户注册协议》
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="submit" value="" class="login_btn" />
						</li>
					</ul>
				</form>

				
			</div>
			
			<div class="mobile fl">
				<h3>手机快速注册</h3>			
				<p>中国大陆手机用户，编辑短信 “<strong>XX</strong>”发送到：</p>
				<p><strong>1069099988</strong></p>
			</div>

		</div>
	</div>
	<!-- 登录主体部分end -->
<script>
    var t;          // 定时器的返回值
    var timer = 0;  // 表示进入倒计时的状态，1表示正在倒计时， 0表示退出倒计时了。
    // 当手机号的输入框时区焦点时
    $('input[name=mobile]').blur(function(){
        // /\d{11}/  是正则表达式，在js，正则也可以是一个对象
        // test 是正则匹配函数，是正则对象内部的方法，参数就是要匹配的内容
        var mb = $('input[name=mobile]').val();

    });

    // 发送短信验证码
    $('.sms_btn').click(function(){
        // 把当前被点击的按钮对象保存在变量中
        var _this = $(this);

        var time = 60;
        // 倒计时
        $('.sms_btn').addClass('disabled');   // 给按钮移除添加样式
        clearInterval( t );
        t = setInterval(function(){
            timer = 1;  //进入倒计时了
            if( time <= 1 ){
                $('.sms_btn').removeClass('disabled'); // 给按钮 .sms_btn 移除禁用样式
                _this.html( '点击发送短信验证码' );    // 把内容重新调整回来
                timer = 0;  //倒计时结束了，退出状态
                clearInterval( t ); // 清除定时器
            }else{
                _this.html( --time + '秒' );           // 倒计时
            }
        },1000);

        // 接收手机号码
        var mb = $('input[name=mobile]').val();

        // 使用ajax发送手机号到后台


    });
</script>

	<!--<div style="clear:both;"></div>
	&lt;!&ndash; 底部版权 start &ndash;&gt;
	<div class="footer w1210 bc mt15">
		<p class="links">
			<a href="">关于我们</a> |
			<a href="">联系我们</a> |
			<a href="">人才招聘</a> |
			<a href="">商家入驻</a> |
			<a href="">千寻网</a> |
			<a href="">奢侈品网</a> |
			<a href="">广告服务</a> |
			<a href="">移动终端</a> |
			<a href="">友情链接</a> |
			<a href="">销售联盟</a> |
			<a href="">京西论坛</a>
		</p>
		<p class="copyright">
			 © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
		</p>
		<p class="auth">
			<a href=""><img src="__Home__/images/xin.png" alt="" /></a>
			<a href=""><img src="__Home__/images/kexin.jpg" alt="" /></a>
			<a href=""><img src="__Home__/images/police.jpg" alt="" /></a>
			<a href=""><img src="__Home__/images/beian.gif" alt="" /></a>
		</p>
	</div>
	&lt;!&ndash; 底部版权 end &ndash;&gt;
-
</body>
</html>-->
<div style="clear:both;"></div>
<!-- 底部版权 start -->
<div class="footer w1210 bc mt15">
  <p class="links">
    <a href="">关于我们</a> |
    <a href="">联系我们</a> |
    <a href="">人才招聘</a> |
    <a href="">商家入驻</a> |
    <a href="">千寻网</a> |
    <a href="">奢侈品网</a> |
    <a href="">广告服务</a> |
    <a href="">移动终端</a> |
    <a href="">友情链接</a> |
    <a href="">销售联盟</a> |
    <a href="">京西论坛</a>
  </p>
  <p class="copyright">
    © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号
  </p>
  <p class="auth">
    <a href=""><img src="/Public/Home/images/xin.png" alt="" /></a>
    <a href=""><img src="/Public/Home/images/kexin.jpg" alt="" /></a>
    <a href=""><img src="/Public/Home/images/police.jpg" alt="" /></a>
    <a href=""><img src="/Public/Home/images/beian.gif" alt="" /></a>
  </p>
</div>
<!-- 底部版权 end -->

</body>
</html>