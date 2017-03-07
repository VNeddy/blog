<?php
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 定义个常量，用来指定本页内容
define('SCRIPT','index');+
// 引入公共文件，转换成硬路径，加快速度
require_once dirname(__FILE__)."/includes/common.inc.php";
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>二哥二姐二姐夫</title>
</head>
<?php require_once ROOT_PATH."includes/title.inc.php"; ?>

<body>
    <div class="wrap clearfix height">
        <!-- 页头开始 -->
        <?php require_once ROOT_PATH."includes/header.inc.php"; ?>
        <!-- 页头结束 -->
        <!-- 内容开始 -->
        <div class="banner">
            <div class="inner">
                <span class="myname">VNeddy Chen</span>
                <span class="myword">世人万千种 浮云莫去求 斯人若彩虹 遇上方知有</span>
            </div>
            <a href="skill.php" class="enter-btn">
                <span class="line line-top"></span>
                <span class="line line-right"></span>
                <span class="line line-bottom"></span>
                <span class="line line-left"></span> 进入
            </a>
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
