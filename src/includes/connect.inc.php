<?php
header('Content-Type:text/html;charset=utf8');
// 防止恶意调用
if (!defined('IN_TG')) {
    exit('Access Defined');
}

// 连接数据库

$mysqli = new mysqli();
@$mysqli->connect(DB_HOST, DB_USER, DB_PWD);
if($mysqli->connect_errno) {
    die("连接数据库失败 ".$mysqli->connect_errno.": ".$mysqli->connect_error);
}
@$mysqli->select_db(DB_NAME);
if($mysqli->errno) {
    die("打开数据库失败 ".$mysqli->errno.": ".$mysqli->error);
}
@$mysqli->set_charset('UTF8');
if($mysqli->errno) {
    die("设置字符集失败 ".$mysqli->errno.": ".$mysqli->error);
}
