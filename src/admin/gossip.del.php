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

$sql = "DELETE FROM gossip WHERE id=$id";

if ($mysqli->query($sql)) {
    echo "<script>alert('删除说说成功');window.location.href='gossip.manage.php'</script>";
} else {
    echo "<script>alert('删除说说失败');window.location.href='gossip.manage.php'</script>";
}

$mysqli->close();
