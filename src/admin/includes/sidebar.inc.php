<?php
// header('Content-Type:text/html;charset=utf8');
// 防止恶意调用
if (!defined('IN_TG')) {
    exit('Access Defined');
}
?>

<div class="sidebar">
    <h3><a href="index.php">后台管理</a></h3>
    <ul>
        <li><a href="article.manage.php">管理文章</a></li>
        <li><a href="article.replay.php">管理文章评论</a></li>
        <li><a href="article.add.php">发布文章</a></li>
        <li><a href="gossip.manage.php">管理说说</a></li>
        <li><a href="gossip.add.php">发布说说</a></li>
        <li><a href="photo.manage.php">管理照片</a></li>
        <li><a href="message.manage.php">管理留言</a></li>
        <li><a href="about.manage.php">管理个人简介</a></li>
    </ul>
</div>
