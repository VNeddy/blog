<?php
// header('Content-Type:text/html;charset=utf8');
// 防止恶意调用
if (!defined('IN_TG')) {
    exit('Access Defined');
}
?>

<footer>
    <span class="copy">
        <span>加载耗时: <?php echo round((_runtime() - START_TIME),5); ?>秒&nbsp;&nbsp;&nbsp;</span>copyright &copy 2016 VNeddy Chen
    </span>
</footer>
