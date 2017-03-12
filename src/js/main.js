$(document).ready(function() {
    /**
     * 导航栏下划线效果
     */
    var current_url = location.href;
    var reg = /^.*\.php.*$/;
    var list_a = $('header').find('ul').find('a');
    if (current_url.search(reg) == -1) {
        // 没有.php后缀说明是首页
        $('header').find('ul').find('a[href=' + "'index.php'" + ']').addClass('current');
    } else if (current_url.search(/^.*gallery\.php$/) === 0) {
        // 画廊归到光影阑珊
        $('header').find('ul').find('a[href=' + "'photo.php'" + ']').addClass('current');
    } else if (current_url.search(/^.*article\.search\.php.*$/) === 0) {
        // 查询文章归到技术圈
        $('header').find('ul').find('a[href=' + "'hot_article.php'" + ']').addClass('current');
    } else {
        for (var i = 0; i < list_a.length; i++) {
            if (list_a[i].href == current_url) {
                $(list_a[i]).addClass('current');
                break;
            }
        }
    }

    /**
     * 回到顶部效果
     */

    var scroll_top = $('#scroll-top');

    scroll_top.on('click', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        // 点击页面停止滚动
        // 添加罩层
        $('<div id="scroll-stop"></div>').insertAfter("body");
        $('#scroll-stop').attr({
            "style": "position:fixed; top:0; bottom:0; left:0; right:0;"
        });

        // 单机罩层，停止滚动并删除罩层
        $('#scroll-stop').on('click', function() {
            $('html, body').stop();
            $('#scroll-stop').remove();
        });
    });

    // 滚动条滚动事件
    $(window).on('scroll', function() {
        // 显示和隐藏按钮
        if ($(window).scrollTop() > $(window).height() / 2) {
            scroll_top.fadeIn();
        } else {
            scroll_top.fadeOut();
        }
        // 若滚动到顶部，删除罩层
        /******** 浏览器兼容问题$('html, body').scrollTop()对Chrome无效 ********/
        // if ($('html').scrollTop() === 0 && $('body').scrollTop() === 0) {
        if ($(window).scrollTop() === 0) {
            $('#scroll-stop').remove();
        }
    });

    // 每次加载页面触发scroll事件
    $(window).trigger('scroll');


    $('.back').on("click",function() {
        window.history.go(-1);
    })
});
