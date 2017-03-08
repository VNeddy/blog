<?php
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 定义个常量，用来指定本页内容
define('SCRIPT','photo');
// 引入公共文件，转换成硬路径，加快速度
require_once dirname(__FILE__)."/includes/common.inc.php";
// 引入连接数据库文件
require_once ROOT_PATH."/includes/connect.inc.php";

$searchSize = 8;


if (isset($_GET['number']) && !empty($_GET['number'])) {
    $searchStart = $_GET['number'] * $searchSize;
    $sql = "SELECT id,url FROM photo ORDER BY id ASC LIMIT $searchStart,$searchSize;";
    $mysqli_result = $mysqli->query($sql);
    if ($mysqli_result && $mysqli_result->num_rows) {
        while ($rows = $mysqli_result->fetch_assoc()) {
            $data[] = $rows;
        }
        echo '{"status":1,"data":'.json_encode($data).'}';
    } else {
        echo '{"status":0}';
    }
    exit;
}

$sql = "SELECT id,url FROM photo ORDER BY id ASC LIMIT 0,$searchSize;";
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
    <title>光影阑珊</title>
</head>
<?php require_once ROOT_PATH."includes/title.inc.php"; ?>
<link rel="stylesheet" href="css/font-awesome.min.css">

<body>
    <div class="wrap clearfix">
        <!-- 页头开始 -->
        <?php require_once ROOT_PATH."includes/header.inc.php"; ?>
        <!-- 页头结束 -->
        <!-- 内容开始 -->
        <div class="mainbody clearfix">
            <?php if (is_array(@$data)) {
                foreach ($data as $val) { ?>
                    <div class="box">
                        <div class="pic">
                            <?php echo "<img src='".$val['url']."' >" ?>
                        </div>
                    </div>
                <?php } } ?>
        </div>
        <!-- 内容结束 -->
        <!-- 页脚开始 -->
        <?php require_once ROOT_PATH."includes/footer.inc.php"; ?>
        <!-- 页脚结束 -->
        <!-- 返回顶部开始 -->
        <?php require_once ROOT_PATH."includes/scroll_top.inc.php" ?>
        <!-- 返回顶部结束 -->
    </div>
    <script src="js/jquery.js" charset="utf-8"></script>
    <script src="js/main.js" charset="utf-8"></script>
    <script src="js/photo.js" charset="utf-8"></script>
</body>

</html>


<?php $mysqli->close(); ?>
