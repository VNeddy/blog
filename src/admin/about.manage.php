<?php
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 定义个常量，用来指定本页内容
define('SCRIPT','about.manage');
// 引入公共文件，转换成硬路径，加快速度
require_once dirname(__FILE__)."/includes/common.inc.php";

// 引入连接数据库文件
require_once ROOT_PATH."/includes/connect.inc.php";

if(!isset($_COOKIE['username'])) {
    echo <<<EOF
    <script type="text/javascript">
    window.onload = function() {
        window.location.href = 'login.php';
    }
    </script>
EOF;
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$num = $mysqli->query("SELECT id FROM about")->num_rows;
$pagesize = 13;
$pagenum = ($page - 1) * $pagesize;
$countpage = ceil($num / $pagesize);
if ($countpage == 1) {
    $countpage = 0;
}

$sql = "SELECT id,content FROM about ORDER BY id ASC LIMIT {$pagenum}, {$pagesize}";
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
    <title>后台管理系统</title>
</head>
<?php require_once ROOT_PATH."includes/title.inc.php"; ?>
<body>
    <div class="wrap">
        <header>
            <h2>向大家介绍一下自己吧</h2>
        </header>
        <div class="mainbody">
            <?php require_once ROOT_PATH."/includes/sidebar.inc.php"; ?>
            <div class="content">
                <table class="current">
                    <?php if (is_array(@$data)) {
                        foreach ($data as $val) { ?>
                            <tr>
                                <td><?php echo $val['content']; ?></td>
                                <td>
                                    <a href="about.del.php?id=<?php echo $val['id']; ?>">删除</a>
                                </td>
                            </tr>
                    <?php } } ?>
                </table>
                <div class="page-num">
                    <ul>
                        <?php for ($i = 0; $i < $countpage; $i++) {
                            if ($page == $i+1) {?>
                            <li><a href="about.manage.php?page=<?php echo $i+1; ?>" class="selected"><?php echo $i+1; ?></a></li>
                        <?php } else { ?>
                            <li><a href="about.manage.php?page=<?php echo $i+1; ?>"><?php echo $i+1; ?></a></li>
                        <?php }} ?>
                    </ul>
                </div>
                <form class="add-about" id="add-about" method="post">
                    <div class="group">
                        <label for="content">发布介绍</label>
                        <textarea name="content" id="content" rows="2" cols="80"></textarea>
                    </div>
                    <input type="submit" name="button" value="发布介绍" class="button" id="submit">
                </form>
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
