<?php
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 定义个常量，用来指定本页内容
define('SCRIPT','message.manage');
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

$num = $mysqli->query("SELECT id FROM article_message")->num_rows;
$pagesize = 15;
$pagenum = ($page - 1) * $pagesize;
$countpage = ceil($num / $pagesize);
if ($countpage == 1) {
    $countpage = 0;
}

// $sql = "SELECT id,tmpuser,content,replay_content,pubTime FROM article_message ORDER BY pubTime DESC LIMIT {$pagenum},{$pagesize}";
$sql = "SELECT article_message.id as message_id,title,article_message.pubTime as message_pubTime,tmpuser,article_message.content as message_content,replay_content FROM article JOIN article_message ON article.id=article_message.article_id ORDER BY article_message.pubTime DESC LIMIT {$pagenum},{$pagesize};";
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
            <h2>在这里，您可以对留言"为所欲为"！</h2>
        </header>
        <div class="mainbody">
            <?php require_once ROOT_PATH."includes/sidebar.inc.php"; ?>
            <div class="content">
                <table>
                    <thead>
                        <tr>
                            <th>文章标题</th>
                            <th>留言时间</th>
                            <th>昵称</th>
                            <th>内容</th>
                            <th>我的回复</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (is_array(@$data)) {
                            foreach ($data as $val) { ?>
                                <tr>
                                    <td><?php echo $val['title']; ?></td>
                                    <td><?php echo date("Y-m-d H:i:s",$val['message_pubTime']); ?></td>
                                    <td><?php echo $val['tmpuser']; ?></td>
                                    <td><?php echo $val['message_content']; ?></td>
                                    <td><?php echo $val['replay_content']; ?></td>
                                    <td>
                                        <a href="javascript:;" class="replay" id="<?php echo $val['message_id']; ?>">回复</a>
                                        <span>|</span>
                                        <a href="article.replay.del.php?id=<?php echo $val['message_id']; ?>">删除</a>
                                    </td>
                                </tr>
                                <?php }
                            } else { ?>
                                <td colspan="6">没有留言</td>
                                <?php } ?>
                    </tbody>
                </table>
                <div class="page-num">
                    <ul>
                        <?php for ($i = 0; $i < $countpage; $i++) {
                            if ($page == $i+1) {?>
                            <li><a href="message.manage.php?page=<?php echo $i+1; ?>" class="selected"><?php echo $i+1; ?></a></li>
                        <?php } else { ?>
                            <li><a href="message.manage.php?page=<?php echo $i+1; ?>"><?php echo $i+1; ?></a></li>
                        <?php }} ?>
                    </ul>
                </div>
            </div>

            <div class="login-layer-wrap">
                <form id="replay_message" method="post">
                    <div class="login-layer">
                        <h2>回复内容</h2>
                        <div class="group">
                            <textarea name="content" placeholder="说点什么吧" id="replay_content"></textarea>
                            <label for="content" class="error"></label>
                        </div>
                        <div class="group">
                            <input type="submit" name="ok" value="确认" class="ok layer-btn">
                            <input type="button" name="cancel" value="取消" class="cancel layer-btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- 页脚开始 -->
        <?php require_once ROOT_PATH."includes/footer.inc.php"; ?>
        <!-- 页脚结束 -->
    </div>
    <script src="../js/jquery.js" charset="utf-8"></script>
    <script src="js/article.replay.js" charset="utf-8"></script>
</body>
</html>
<?php $mysqli->close(); ?>
