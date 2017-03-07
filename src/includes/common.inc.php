<?php
header('Content-Type:text/html;charset=utf8');
// 防止恶意调用
if (!defined('IN_TG')) {
    exit('Access Defined');
}

// 转换硬路径常亮
define('ROOT_PATH',substr(dirname(__FILE__),0,-8));

// 拒绝PHP低版本
if(PHP_VERSION < '4.1.0') {
    exit('PHP版本太低');
}

// 引入核心函数库
require_once ROOT_PATH."includes/global.func.php";

// 执行耗时
define('START_TIME', _runtime());

// 数据库连接
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD','root');
define('DB_NAME','vneddy');
