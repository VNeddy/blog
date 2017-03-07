<?php
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 定义个常量，用来指定本页内容
define('SCRIPT','about');
// 引入公共文件，转换成硬路径，加快速度
require_once dirname(__FILE__)."/includes/common.inc.php";
// 引入连接数据库文件
require_once ROOT_PATH."/includes/connect.inc.php";

$sql = "SELECT id,content FROM about ORDER BY id ASC";
$mysqli_result = $mysqli->query($sql);

if ($mysqli_result && $mysqli_result->num_rows) {
    while ($rows = $mysqli_result->fetch_assoc()) {
        $data[] = $rows;
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>关于我</title>
</head>
<?php require_once ROOT_PATH."includes/title.inc.php"; ?>

<body>
    <div class="wrap clearfix">
        <!-- 页头开始 -->
        <?php require_once ROOT_PATH."includes/header.inc.php"; ?>
        <!-- 页头结束 -->
        <!-- 内容开始 -->
        <div class="mainbody clearfix">
            <div class="about-wrap">
                <article>
                    <h2>《个人简介》</h2>
                    <?php if (is_array(@$data)) {
                        foreach ($data as $val) { ?>
                    <p class="line-bg"><?php echo $val['content']; ?></p>
                    <?php } } ?>
                </article>
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
