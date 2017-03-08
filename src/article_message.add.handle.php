<?php
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 引入公共文件，转换成硬路径，加快速度
require_once dirname(__FILE__)."/includes/common.inc.php";
// 引入连接数据库文件
require_once ROOT_PATH."includes/connect.inc.php";

// 引入过滤数据文件
require_once ROOT_PATH."includes/filter.class.php";
$arr = array();
// 指定当前文件，以确保正确过滤内容
$current = "message";
$res = Filter::validate($arr,$current);
if ($res) {
    $arr['sex'] = $_POST['sex'];
    $arr['id'] = $_POST['id'];
    $arr['pubTime'] = time();
    $sql = "INSERT INTO article_message(article_id,tmpuser,sex,content,pubTime) VALUES(?,?,?,?,?);";
    $mysqli_stmt = $mysqli->prepare($sql);
    $mysqli_stmt->bind_param('isssi',$arr['id'],$arr['tmpuser'],$arr['sex'],$arr['content'],$arr['pubTime']);
    $mysqli_stmt->execute();
    // 无刷新评论
    $date_str = date("Y-m-d H:i:s",$arr['pubTime']);
    $html = <<<EOF

        <div class="comment clearfix">
            <div class="user-avatar">
                <img src="img/{$arr['sex']}.png" alt="用户头像">
            </div>
            <div class="comment-info">
                <div class="comment-header clearfix">
                    <span class="user-name">{$arr['tmpuser']}</span>
                    <span class="comment-date">{$date_str}</span>
                </div>
                <div class="comment-comtent">
                    <span>{$arr['content']}</span>
                </div>
            </div>
        </div>

EOF;
    echo json_encode(array('status'=>1,'html'=>$html));
} else {
    echo '{"status":0,"errors":'.json_encode($arr).'}';
}
$mysqli->close();
?>
