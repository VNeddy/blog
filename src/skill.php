<?php
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 定义个常量，用来指定本页内容
define('SCRIPT','skill');
// 引入公共文件，转换成硬路径，加快速度
require_once dirname(__FILE__)."/includes/common.inc.php";

// 引入连接数据库文件
require_once ROOT_PATH."/includes/connect.inc.php";

//分页模块
if (isset($_GET['page'])) {
    $_page = $_GET['page'];
} else {
    $_page = 1;
}
$_pagesize = 6;
$_pagenum = ($_page - 1) * $_pagesize;

// 首先要得到所有的数据总和
$mysqli_result_1 = $mysqli->query("SELECT id,title FROM article ORDER BY pubTime DESC");
$_num = $mysqli_result_1->num_rows;
$_count_page = ceil($_num / $_pagesize);
if ($_count_page == 1) {
    $_count_page = 0;
}
// 显示分页内容内容
$sql = "SELECT * FROM article ORDER BY pubTime DESC LIMIT $_pagenum,$_pagesize";

$mysqli_result = $mysqli->query($sql);

if ($mysqli_result && $mysqli_result->num_rows) {
    while ($rows = $mysqli_result->fetch_assoc()) {
        $data[] = $rows;
    }
}
if ($mysqli_result->num_rows < 2) {
        echo <<<EOF
        <script type="text/javascript">
        window.onload = function() {
            var classVal = document.getElementsByClassName("wrap")[0].getAttribute("class");
            classVal = classVal.concat(" min-height");
            document.getElementsByClassName("wrap")[0].setAttribute("class",classVal );
        }
        </script>
EOF;
}

// 显示最新文章列表
if ($mysqli_result_1 && $mysqli_result_1->num_rows) {
    while ($rows = $mysqli_result_1->fetch_assoc()) {
        $_new_article[] = $rows;
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>技术圈</title>
</head>
<?php require_once ROOT_PATH."includes/title.inc.php"; ?>

<body>
    <div class="wrap clearfix">
        <!-- 页头开始 -->
        <?php require_once ROOT_PATH."includes/header.inc.php"; ?>
        <!-- 页头结束 -->
        <!-- 内容开始 -->
        <div class="mainbody clearfix">
            <div class="content">
                <h2 class="hot-article" id="hot-article"><span>热门文章</span></h2>
                <?php
                if (is_array(@$data)) {
                    foreach ($data as $val) { ?>
                        <div class="post clearfix">
                            <h2 class="title"><?php echo "<a href='article.php?id=".$val['id']."'>".$val['title']."</a>"; ?>
                                <span class="date"><?php echo date("Y年m月d日 H:i:s",$val['pubTime']); ?></span>
                                <span class="author"><?php
                                if ($val['url']) {
                                    echo "<a href='".$val['url']."' target='_blank'>".$val['author']."</a>";
                                } else {
                                    echo $val['author'];
                                }
                                ?></span>
                            </h2>
                            <p>
                                <?php echo $val['content']; ?>
                            </p>
                            <p class="view-comment">
                                <!-- 浏览:<span>3</span> | 评论:<span>3</span> -->
                                <a href="article.php?id=<?php echo $val['id']; ?>" class="more">详细内容<span>&nbsp;&nbsp;»&nbsp;&nbsp;</span></a>
                            </p>
                        </div>
                <?php }} else { ?>
                    <strong>当前没有文章，请联系管理员添加 ^_^</strong>
                <?php } ?>
                <div class="page-num">
                    <ul>
                        <?php for ($i = 0; $i < $_count_page; $i++) {
                            if ($_page == $i+1) {?>
                            <li><a href="skill.php?page=<?php echo $i+1; ?>" class="selected"><?php echo $i+1; ?></a></li>
                            <?php } else { ?>
                            <li><a href="skill.php?page=<?php echo $i+1; ?>"><?php echo $i+1; ?></a></li>
                        <?php }} ?>
                    </ul>
                </div>
            </div>
            <div class="search">
                <h2 class="search-article">查找文章</h2>
                <div class="search-text-box">
                    <form action="article.search.php" method="get">
                        <input type="text" name="search" class="search-text">
                        <button type="submit" class="search-btn">查 询</button>
                    </form>
                </div>
            </div>
            <div class="recommend">
                <h2 class="recommend-article">最新文章</h2>
                <ul>
                    <?php
                    if (is_array(@$_new_article)) {
                        for ($i = 0; $i < (6<count($_new_article,0)?6:count($_new_article,0)); $i++) { ?>
                            <a href="article.php?id=<?php echo $_new_article[$i]['id']; ?>"><li><?php echo $_new_article[$i]['title']; ?></li></a>
                    <?php }} ?>
                </ul>
            </div>
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
</body>

</html>

<?php $mysqli->close(); ?>
