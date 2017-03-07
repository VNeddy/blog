<?php
header('Content-Type:text/html;charset=utf8');
// 防止恶意调用
if (!defined('IN_TG')) {
    exit('Access Defined');
}
// 防止非HTML页面调用
if (!defined('SCRIPT')) {
    exit('Script Error');
}
?>

<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/<?php echo SCRIPT; ?>.css">
