<?php
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 引入公共文件，转换成硬路径，加快速度
require_once dirname(__FILE__)."/includes/common.inc.php";
// 启用SESSION
session_start();
// 调用生成验证码函数，共三个参数，验证码图片长度，验证码图片高度，验证码个数
_code(100, 30, 4);
