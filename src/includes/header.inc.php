<?php
header('Content-Type:text/html;charset=utf8');
// 防止恶意调用
if (!defined('IN_TG')) {
    exit('Access Defined');
}
?>

<header>
    <div class="nav">
        <nav class="clearfix">
            <div class="logo">
                <a href="index.php"><img src="img/logo.png" alt="logo"></a>
            </div>
            <ul>
                <li><a href="index.php">首页</a></li>
                <li><a href="skill.php">技术圈</a></li>
                <li><a href="gossip.php">碎语闲言</a></li>
                <li><a href="photo.php">光影阑珊</a></li>
                <li><a href="message.php">留言板</a></li>
                <li><a href="about.php">关于我</a></li>
            </ul>
        </nav>
    </div>
</header>
