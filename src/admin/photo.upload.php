<?php
// 定义个常量，用来授权调用includes里的常量
define('IN_TG',true);
// 引入公共文件，转换成硬路径，加快速度
require_once dirname(__FILE__)."/includes/common.inc.php";
// 引入连接数据库文件
require_once ROOT_PATH."/includes/connect.inc.php";

if ($_FILES["mypic"]["name"] != "") {
    if ($_FILES["mypic"]['size'] > 1024000) { //限制上传大小
        echo '{"status":0,"errors":{"mypic":"图片大小不能超过1M"}}';
        exit;
    }
    //限制上传格式
    if ($_FILES['mypic']['type'] != "image/gif" && $_FILES['mypic']['type'] != "image/jpeg" && $_FILES['mypic']['type'] != "image/png") {
        echo '{"status":0,"errors":{"mypic":"图片格式不对"}}';;
        exit;
    }
    //上传路径
    $pic_path = "../img/photo/".$_FILES['mypic']['name'];
    if (file_exists($pic_path)) {
        echo '{"status":0,"errors":{"mypic":"图片已经存在"}}';
    } else {
        move_uploaded_file($_FILES["mypic"]["tmp_name"],
      $pic_path);
    //   存入数据库
    $pic_data_path = 'img/photo/'.$_FILES['mypic']['name'];
    $sql = "INSERT INTO photo(url) VALUES(?);";
    $mysqli_stmt = $mysqli->prepare($sql);
    $mysqli_stmt->bind_param('s',$pic_data_path);
    $mysqli_stmt->execute();
    $mysqli->close();
    echo '{"status":1}';
    }
} else {
    echo '{"status":0,"errors":{"mypic":"请选择文件"}}';;
}
