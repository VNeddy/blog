<?php
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 定义个常量，用来指定本页内容
define('SCRIPT','index');
// 引入公共文件，转换成硬路径，加快速度
require_once dirname(__FILE__)."/includes/common.inc.php";
if(!isset($_COOKIE['username'])) {
    echo <<<EOF
    <script type="text/javascript">
    window.onload = function() {
        window.location.href = 'login.php';
    }
    </script>
EOF;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>后台管理系统</title>
</head>
<?php require_once ROOT_PATH."includes/title.inc.php"; ?>
<body>
    <div class="wrap">
        <header>
            <h2>后台管理</h2>
        </header>
        <div class="mainbody">
            <?php require_once ROOT_PATH."includes/sidebar.inc.php"; ?>
            <div class="content">
                <div class="welcome">
                    <p>欢迎您: </p>
                    <p>尊敬的<?php
                        if(isset($_COOKIE['username'])) {
                            echo $_COOKIE['username'];
                        }
                    ?></p><!-- 在这里添加管理员昵称 -->
                    <p>在这里您是至高无上的存在！</p>
                </div>
            </div>
        </div>
        <!-- 页脚开始 -->
        <?php require_once ROOT_PATH."includes/footer.inc.php"; ?>
        <!-- 页脚结束 -->
    </div>
    <script src="../js/jquery.js" charset="utf-8"></script>
    <script src="js/main.js" charset="utf-8"></script>
</body>
</html>
