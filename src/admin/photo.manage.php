<?php
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 定义个常量，用来指定本页内容
define('SCRIPT','photo.manage');
// 引入公共文件，转换成硬路径，加快速度
require_once dirname(__FILE__)."/includes/common.inc.php";

// 引入连接数据库文件
require_once ROOT_PATH."/includes/connect.inc.php";

// 检查登录状态
if (isset($_COOKIE['username'])) {
    $sql1 = "SELECT * FROM admin WHERE username='{$_COOKIE['username']}';";
    $mysqli_result = $mysqli->query($sql1);
    $rows = $mysqli_result->fetch_array();
    if ($rows['uniqid'] != $_COOKIE['uniqid']) {
        setcookie('username','',time()-1);
        setcookie('uniqid','',time()-1);
        echo <<<EOF
        <script type="text/javascript">
        window.onload = function() {
            alert("您的账号已在别处登录");
            window.location.href = 'login.php';
        }
        </script>
EOF;
    }
} else {
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

$num = $mysqli->query("SELECT id FROM photo")->num_rows;
$pagesize = 4;
$pagenum = ($page - 1) * $pagesize;
$countpage = ceil($num / $pagesize);
if ($countpage == 1) {
    $countpage = 0;
}

$sql = "SELECT id,url FROM photo ORDER BY id DESC LIMIT {$pagenum}, {$pagesize}";
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
            <h2>添加或删除照片</h2>
        </header>
        <div class="mainbody">
            <?php require_once ROOT_PATH."/includes/sidebar.inc.php"; ?>
            <div class="content">
                <div class="current">
                    <?php if (is_array(@$data)) {
                        foreach ($data as $val) { ?>
                            <div class="img-info">
                                <img src=<?php echo "../".$val['url']; ?>>
                                <span>URL: <?php echo $val['url']; ?></span>
                                <span><a href="photo.del.php?id=<?php echo $val['id']; ?>">删除</a></span>
                            </div>
                    <?php } } ?>
                </div>
                <div class="page-num">
                    <ul>
                        <?php for ($i = 0; $i < $countpage; $i++) {
                            if ($page == $i+1) {?>
                            <li><a href="photo.manage.php?page=<?php echo $i+1; ?>" class="selected"><?php echo $i+1; ?></a></li>
                        <?php } else { ?>
                            <li><a href="photo.manage.php?page=<?php echo $i+1; ?>"><?php echo $i+1; ?></a></li>
                        <?php }} ?>
                    </ul>
                </div>
                <form method="post" enctype="multipart/form-data" class="add-pic" id="add-pic">
                    <div class="group">
                        <label for="mypic">上传照片(支持jif/png/jepg格式照片，大小不得超过1M)</label>
                        <input type="file" name="mypic">
                        <input type="submit" name="button" value="上传照片" class="button" id="submit">
                    </div>
                </form>
            </div>
        </div>
        <!-- 页脚开始 -->
        <?php require_once ROOT_PATH."includes/footer.inc.php"; ?>
        <!-- 页脚结束 -->
    </div>
    <script src="../js/jquery.js" charset="utf-8"></script>
    <script src="js/photo.manage.js" charset="utf-8"></script>
</body>
</html>
