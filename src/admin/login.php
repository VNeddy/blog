<?php
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 定义个常量，用来指定本页内容
define('SCRIPT','login');
// 引入公共文件，转换成硬路径，加快速度
require_once dirname(__FILE__)."/includes/common.inc.php";

if(isset($_COOKIE['username'])) {
    echo <<<EOF
    <script type="text/javascript">
    window.onload = function() {
        window.location.href = 'index.php';
    }
    </script>
EOF;
}

if(@$_GET['action'] == 'login') {
    // 引入连接数据库文件
    require_once ROOT_PATH."includes/connect.inc.php";
    session_start();
    if($_SESSION['code'] == $_POST['code']) {
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        // 使用预处理语句防止SQL注入
        $sql = "SELECT * FROM admin WHERE username=? AND password=?";
        $mysqli_stmt = $mysqli->prepare($sql);
        $mysqli_stmt->bind_param('ss',$username,$password);
        if($mysqli_stmt->execute()) {
            $mysqli_stmt->store_result();
            if($mysqli_stmt->num_rows > 0) {
                $uniqid = sha1(uniqid(rand(),true));
                $sql1 = "UPDATE admin SET uniqid='{$uniqid}' WHERE username='{$username}';";
                $mysqli->query($sql1);
                echo json_encode(array('status'=>1));
                setcookie('username', $username);
                setcookie('uniqid', $uniqid);
            } else {
                echo '{"status":0,"errors":'.json_encode(array('username'=>'用户名或密码错误')).'}';
            }
        }
    } else {
        echo '{"status":0,"errors":'.json_encode(array('code'=>'验证码不正确')).'}';
    }
    $mysqli->close();
    session_destroy();
    return false;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>管理员登录</title>
    </head>
    <?php require_once ROOT_PATH."includes/title.inc.php"; ?>
    <body>
        <div class="mainbody">
    		<div class="login-html">
    			<h3>登录</h3>
    			<div class="login-form">
                    <form class="sign-in-htm" id="login" autocomplete="off">
    					<div class="group">
    						<input name="username" id="username" type="text" class="input" placeholder="请输入用户名"/>
                            <label for="username" class="warning"></label>
    					</div>
    					<div class="group">
    						<input name="password" id="pass" type="password" class="input" data-type="password" placeholder="请输入密码"/>
    					</div>
                        <div class="group">
    						<input name="code" type="text" class="input" placeholder="请输入验证码"/>
                            <img src="code.php" alt="验证码" id="code">
                            <label for="code" class="warning"></label>
    					</div>
    					<div class="group">
    						<input type="submit" class="button" id="submit" value="登录" />
    					</div>
    				</form>
    			</div>
    		</div>
            <?php require_once ROOT_PATH."includes/footer.inc.php"; ?>
        </div>
    </body>
    <script src="../js/jquery.js" charset="utf-8"></script>
    <script src="js/login.js" charset="utf-8"></script>
</html>
