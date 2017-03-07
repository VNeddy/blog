<?php
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 定义个常量，用来指定本页内容
define('SCRIPT','register');
// 引入公共文件，转换成硬路径，加快速度
require_once dirname(__FILE__)."/includes/common.inc.php";
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录/注册</title>
</head>
<?php require_once ROOT_PATH."includes/title.inc.php"; ?>

<body>
    <div class="wrap clearfix">
        <!-- 页头开始 -->
        <?php require_once ROOT_PATH."includes/header.inc.php"; ?>
        <!-- 页头结束 -->
        <!-- 内容开始 -->
        <div class="mainbody clearfix">
    		<div class="login-html">
    			<input id="tab-1" type="radio" name="tab" class="sign-in" checked /><label for="tab-1" class="tab">登录</label>
    			<input id="tab-2" type="radio" name="tab" class="sign-up" /><label for="tab-2" class="tab">注册</label>
    			<div class="login-form">
                    <form class="sign-in-htm" action="register.php?" method="post" autocomplete="off">
    					<div class="group">
    						<input id="user" type="text" class="input" placeholder="请输入用户名"/>
    					</div>
    					<div class="group">
    						<input id="pass" type="password" class="input" data-type="password" placeholder="请输入密码"/>
    					</div>
    					<div class="group">
    						<input id="check" type="checkbox" class="check" checked />
    						<label for="check"><span class="icon"></span> 记住密码</label>
    					</div>
    					<div class="group">
    						<input type="submit" class="button" value="登录" />
    					</div>
    					<div class="hr"></div>
    					<div class="foot-lnk">
    						<a href="#forgot">忘记密码?</a>
    					</div>
    				</form>
    				<form class="sign-up-htm" action="register.php?" method="post" autocomplete="off">
    					<div class="group">
    						<input name="username" type="text" class="input" placeholder="请输入用户名"/>
                            <span>1-16位用户名</span>
    					</div>
    					<div class="group">
    						<input name="password" type="password" class="input" placeholder="请输入密码"/>
                            <span>1-16位密码</span>
    					</div>
    					<div class="group">
    						<input name="repassword" type="password" class="input" placeholder="确认密码"/>
                            <span>再次输入密码</span>
    					</div>
    					<div class="group">
    						<input name="email" type="email" class="input" placeholder="请输入邮箱"/>
                            <span>输入您常用的邮箱</span>
    					</div>
                        <div class="group">
    						<input name="code" type="text" class="input" placeholder="请输入验证码"/>
                            <img src="code.php" alt="验证码" id="code">
    					</div>
                        <div class="group text-center">
    						<input id="check1" type="checkbox" class="check" checked />
    						<label for="check1"><span class="icon"></span> 同意<a href="javascript:;">"用户须知"</a></label>
    					</div>
    					<div class="group">
    						<input type="submit" class="button" value="注册" />
    					</div>
    					<div class="hr"></div>
    					<div class="foot-lnk">
    						<label for="tab-1">已注册登录?</a>
    					</div>
    				</form>
    			</div>
    		</div>
        </div>
        <!-- 内容结束 -->
        <!-- 页脚开始 -->
        <?php require_once ROOT_PATH."includes/footer.inc.php"; ?>
        <!-- 页脚结束 -->
    </div>
    <script src="js/jquery.js" charset="utf-8"></script>
    <script src="js/main.js" charset="utf-8"></script>
</body>

</html>
