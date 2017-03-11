<?php
// 防止恶意调用
// if (!defined('IN_TG')) {
//     exit('Access Defined');
// }
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 引入公共文件，转换成硬路径，加快速度
require_once dirname(__FILE__)."/includes/common.inc.php";
// 引入连接数据库文件
require_once ROOT_PATH."/includes/connect.inc.php";

$id = $_GET['id'];

$sql = "SELECT url FROM photo WHERE id=$id";
$mysqli_result = $mysqli->query($sql);
if ($mysqli_result && $mysqli_result->num_rows) {
    $rows = $mysqli_result->fetch_array();
    $del_path = "../".$rows['url'];
    unlink($del_path);
}

$sql1 = "DELETE FROM photo WHERE id=$id";

if ($mysqli->query($sql1)) {
    echo "<script>alert('删除成功');window.location.href='photo.manage.php'</script>";
} else {
    echo "<script>alert('删除失败');window.location.href='photo.manage.php'</script>";
}

$mysqli->close();
