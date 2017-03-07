<?php
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 引入公共文件，转换成硬路径，加快速度
require_once dirname(__FILE__)."/includes/common.inc.php";
// 引入连接数据库文件
require_once ROOT_PATH."/includes/connect.inc.php";

// 引入过滤数据文件
require_once ROOT_PATH."/includes/filter.class.php";
$id = $_POST['id'];
$arr = array();
// 指定当前文件，以确保正确过滤内容
$current = "article";
$res = Filter::validate($arr,$current);
if ($res) {
    $arr['pubTime'] = time();
    $sql = "UPDATE article SET title=?,author=?,url=?,content=?,pubTime=? WHERE id=?";
    $mysqli_stmt = $mysqli->prepare($sql);
    $mysqli_stmt->bind_param('ssssii',$arr['title'],$arr['author'],$arr['url'],$arr['content'],$arr['pubTime'],$id);
    $mysqli_stmt->execute();
    echo json_encode(array('status'=>1));
} else {
    echo '{"status":0,"errors":'.json_encode($arr).'}';
}
$mysqli->close();
?>
