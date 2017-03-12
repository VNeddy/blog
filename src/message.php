<?php
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 定义个常量，用来指定本页内容
define('SCRIPT','message');
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
$_pagesize = 10;
$_pagenum = ($_page - 1) * $_pagesize;

// 首先要得到所有的数据总和
$mysqli_result_1 = $mysqli->query("SELECT id FROM message");
$_num = $mysqli_result_1->num_rows;
$_count_page = ceil($_num / $_pagesize);
if ($_count_page == 1) {
    $_count_page = 0;
}
// 显示分页内容内容
$sql = "SELECT * FROM message ORDER BY pubTime DESC LIMIT $_pagenum,$_pagesize";

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
        <title>留言板</title>
    </head>
    <?php require_once ROOT_PATH."includes/title.inc.php"; ?>

    <body>
        <div class="wrap clearfix">
            <!-- 页头开始 -->
            <?php require_once ROOT_PATH."includes/header.inc.php"; ?>
            <!-- 页头结束 -->
            <!-- 内容开始 -->
            <div class="mainbody">
                <div class="message-wrap">
                    <article>
                        <h2>留言板</h2>
                        <p>有什么要对我说的么 ^_^</p>
                    </article>
                    <!-- 留言展示开始 -->
                    <div class="comment-wrap">

                        <?php
                        if (is_array(@$data)) {
                            foreach (@$data as $val) { ?>

                        <div class="comment clearfix">
                            <div class="user-avatar">
                                <img src="img/<?php echo $val['sex']; ?>.png" alt="用户头像">
                            </div>
                            <div class="comment-info">
                                <div class="comment-header clearfix">
                                    <span class="user-name"><?php echo $val['tmpuser']; ?></span>
                                    <span class="comment-date"><?php echo date("Y-m-d H:i:s",$val['pubTime']); ?></span>
                                </div>
                                <div class="comment-comtent">
                                    <span><?php echo $val['content']; ?></span>
                                    <?php if ($val['replay_content'] != null) { ?>
                                    <div class="comment-info">
                                        <div class="comment-header clearfix">
                                            <span class="user-name">from: admin</span>
                                            <span class="comment-date"><?php echo date("Y-m-d H:i:s",$val['replayTime']); ?></span>
                                        </div>
                                        <div class="comment-comtent">
                                            <span><?php echo $val['replay_content']; ?></span>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <?php }} else { ?>
                            <p>当前没有留言，你是第一个哦<br>留下些什么吧 ^_^</p>
                        <?php } ?>

                        <!-- 用于无刷新显示留言 -->
                        <div id="insert"></div>
                    </div>
                    <!-- 留言展示结束 -->
                    <!-- 分页开始 -->
                    <div class="page-num">
                        <ul>
                            <?php for ($i = 0; $i < $_count_page; $i++) {
                                if ($_page == $i+1) {?>
                                <li><a href="message.php?page=<?php echo $i+1; ?>" class="selected"><?php echo $i+1; ?></a></li>
                                <?php } else { ?>
                                <li><a href="message.php?page=<?php echo $i+1; ?>"><?php echo $i+1; ?></a></li>
                            <?php }} ?>
                        </ul>
                    </div>
                    <!-- 分页结束 -->
                    <!-- 留言开始 -->
                    <div class="comment-form clearfix">
                        <form method="post" id="add-message">
                            <textarea name="content" placeholder="说点什么吧" id="message-content"></textarea>
                            <input type="button" value="留言" id="message-button">
                            <div class="login-layer-wrap">
                                <div class="login-layer">
                                    <h2>作为游客留言</h2>
                                    <div class="group">
                                        <label for="tmpuser"></label>
                                        <input id="tmpuser" type="text" name="tmpuser" placeholder="请输入昵称(必填)">
                                    </div>
                                    <div class="group">
                                        <span class="choose">请选择性别(必选)</span>
                                        <label for="male">男</label>
                                        <input id="male" type="radio" name="sex" value="male" checked>
                                        <label for="female">女</label>
                                        <input id="female" type="radio" name="sex" value="female">
                                    </div>
                                    <div class="group">
                                        <input type="submit" name="ok" value="确认" class="ok layer-btn">
                                        <input type="button" name="cancel" value="取消" class="cancel layer-btn">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="is-empty-wrap">
                        <div class="is-empty">
                            <p>写点什么啊 ^_^!</p>
                            <button type="button" class="is-empty-btn">好的</button>
                        </div>
                    </div>
                    <!-- 留言结束 -->
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
        <script src="js/message.js" charset="utf-8"></script>
    </body>

    </html>
