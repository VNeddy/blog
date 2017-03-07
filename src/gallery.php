<?php
// 定义个常量，用来授权调用includes里的常亮
define('IN_TG',true);
// 定义个常量，用来指定本页内容
define('SCRIPT','gallery');
// 引入公共文件，转换成硬路径，加快速度
require_once dirname(__FILE__)."/includes/common.inc.php";
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>照片集</title>
</head>
<?php require_once ROOT_PATH."includes/title.inc.php"; ?>
<link rel="stylesheet" href="css/photo.css">
<link rel="stylesheet" href="css/font-awesome.min.css">

<body>
    <div class="wrap clearfix">
        <!-- 页头开始 -->
        <?php require_once ROOT_PATH."includes/header.inc.php"; ?>
        <!-- 页头结束 -->
        <!-- 内容开始 -->
        <div class="mainbody clearfix">
            <aside class="photo-menu">
                <div class="menu-container home">
                    <a href="photo.php">
                        <span>PHOTO HOME</span>
                    </a>
                </div>
                <div class="menu-container menu-gallery">
                    <a href="gallery.php">
                        <span>GALLERY</span>
                    </a>
                </div>
                <!-- <div class="menu-container">
                    <div class="carousel">
                        <div class="ltem">
                            <img src="img/photo/slider-img-1.png" alt="slider">
                        </div>
                        <div class="ltem">
                            <img src="img/photo/menu-bg-home.png" alt="slider">
                        </div>
                    </div>
                </div> -->
            </aside>
            <div class="photo-container">
                <div class="banner main-home gallery">
                    <div class="gallery-heading">
                        <h3>GALLERY</h3>
                        <h4>RESPONSIVE DESIGN</h4>
                    </div>
                    <div class="img-box">
                        <a href="img/gallery/gallery-item-1-big.jpg"><img alt="Agra picture" src="img/gallery/gallery-item-1.jpg"></a>
                        <a href="img/gallery/gallery-item-2-big.jpg"><img alt="Agra picture" src="img/gallery/gallery-item-2.jpg"></a>
                        <a href="img/gallery/gallery-item-3-big.jpg"><img alt="Agra picture" src="img/gallery/gallery-item-3.jpg"></a>
                        <a href="img/gallery/gallery-item-4-big.jpg"><img alt="Agra picture" src="img/gallery/gallery-item-4.jpg"></a>
                        <a href="img/gallery/gallery-item-5-big.jpg"><img alt="Agra picture" src="img/gallery/gallery-item-5.jpg"></a>
                    </div>
                    <div class="view-more-wrap">
                        <a href="javascript:;" class="view-more">VIEW MORE</a>
                    </div>
                </div>
            </div>
            <!-- 内容结束 -->
            <!-- 页脚开始 -->
            <?php require_once ROOT_PATH."includes/footer.inc.php"; ?>
            <!-- 页脚结束 -->
            <!-- 返回顶部开始 -->
            <?php require_once ROOT_PATH."includes/scroll_top.inc.php" ?>
            <!-- 返回顶部结束 -->
        </div>
    </div>
    <script src="js/jquery.js" charset="utf-8"></script>
    <script src="js/main.js" charset="utf-8"></script>
</body>

</html>
