<?php
// 防止恶意调用
// if (!defined('IN_TG')) {
//     exit('Access Defined');
// }
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 引入公共文件，转换成硬路径，加快速度
require_once dirname(__FILE__)."/includes/common.inc.php";
// 引入过滤数据文件
require_once ROOT_PATH."includes/filter.class.php";

// 引入连接数据库文件
require_once ROOT_PATH."/includes/connect.inc.php";

$arr = array();
// 指定当前文件，以确保正确过滤内容
$current = "replay";
$res = Filter::validate($arr,$current);
if ($res) {
    $arr['message_id'] = $_GET['id'];
    $arr['replayTime'] = time();
    $sql = "UPDATE article_message SET replay_content=?,replayTime=? WHERE id={$arr['message_id']};";
    $mysqli_stmt = $mysqli->prepare($sql);
    $mysqli_stmt->bind_param('si',$arr['content'],$arr['replayTime']);
    $mysqli_stmt->execute();
    echo json_encode(array('status'=>1));
} else {
    echo '{"status":0,"errors":'.json_encode($arr).'}';
}
$mysqli->close();
