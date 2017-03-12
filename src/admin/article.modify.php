<?php
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 定义个常量，用来指定本页内容
define('SCRIPT','article.add');
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

$id = $_GET['id'];
$sql = "SELECT * FROM article WHERE id=$id";
$data = $mysqli->query($sql)->fetch_assoc();
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
            <h2>在这里，您可以随心所欲的修改文章！</h2>
        </header>
        <div class="mainbody">
            <?php require_once ROOT_PATH."/includes/sidebar.inc.php"; ?>
            <div class="content">
                <form class="add-article" id="modify-article" method="post">
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                    <div class="group">
                        <label for="title">文章标题</label>
                        <input type="text" name="title" id="title" value="<?php echo $data['title']; ?>">
                    </div>
                    <div class="group">
                        <label for="author">作者</label>
                        <input type="text" name="author" id="autohr" value="<?php echo $data['author']; ?>">
                    </div>
                    <div class="group">
                        <label for="url">作者URL</label>
                        <input type="text" name="url" id="url" value="<?php echo $data['url']; ?>">
                    </div>
                    <div class="group flag">
                        <label for="content">文章内容</label>
                        <textarea name="content" id="content" rows="15" cols="80"><?php echo br2nl($data['content']); ?></textarea>
                    </div>
                    <input type="submit" name="button" value="修改文章" class="button" id="submit">
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
