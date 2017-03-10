$(document).ready(function(){
    var timer = setInterval(waterFall,100);
    var number = 0;
    var flag = true;
    // 动态的加载图片
    $(window).on('scroll', function(){
        if (checkScrollSlide() && flag) {
            number++;
            $.ajax({
                type: "GET",
                url: "photo.php?number=" + number,
                async: false,
                dataType: "json",
                success: function(dataInt) {
                    if (dataInt.status) {
                        $.each(dataInt.data, function(index, value) {
                            var oBox = $('<div>').addClass('box').appendTo($('.mainbody'));
                            var oPic = $('<div>').addClass('pic').appendTo($(oBox));
                            $('<img>').addClass('js-lightbox').attr('src', value.url).appendTo(oPic);
                        });
                    } else {
                        flag = false;
                        setTimeout(function() {
                            clearInterval(timer);
                        },1000);
                    }
                },
            });
        }
    });

    // 因为动态加载图片，图片弹出时，通过事件委托机制绑定到body上
    $(document.body).delegate(".js-lightbox","click",function() {
        var picSrc = $(this).attr('src');
        // 弹出幕布并加载图片
        showLightbox(picSrc);
    });

    // 点击遮罩层或关闭按钮隐藏大图
    $('.lightbox-wrap,.lightbox-close-btn').on("click",function() {
        $('.lightbox-wrap').fadeOut();
        $('.lightbox').fadeOut();
        // 解除滚动条锁定
        // $(document.body).css({"overflow":"visible"});
    });

    // 鼠标移动到上一张/下一张/和关闭按钮的效果
    $('.lightbox-btn-prev').on("mouseover",function() {
        $(this).addClass("lightbox-btn-prev-show");
    });
    $('.lightbox-btn-next').on("mouseover",function() {
        $(this).addClass("lightbox-btn-next-show");
    });
    $('.lightbox-btn-prev').on("mouseout",function() {
        $(this).removeClass("lightbox-btn-prev-show");
    });
    $('.lightbox-btn-next').on("mouseout",function() {
        $(this).removeClass("lightbox-btn-next-show");
    });
    $('.lightbox-close-btn').on("mouseover",function() {
        $(this).addClass("lightbox-close-btn-show");
    });
    $('.lightbox-close-btn').on("mouseout",function() {
        $(this).removeClass("lightbox-close-btn-show");
    });

});

function waterFall() {
    var $boxs = $('.mainbody').find('.box');
    // 盒子宽度
    var boxW = $boxs.eq(0).outerWidth();
    // 列数
    var cols = Math.floor($(window).width() / boxW);
    // 根据盒子宽度和列数计算mainbody宽度，并居中
    $('.mainbody').css({
        'width': boxW * cols + 'px',
        'margin': '0 auto'
    });
    var hArr = [];
    $boxs.each(function(index, value) {
        var thisH = $boxs.eq(index).outerHeight();
        if(index < cols) {
            // 将第一行的高度放入数组（到顶部的距离加上本身高度）
            hArr.push(thisH  + $boxs.eq(index).offset().top);
        } else {
            // 获取数组中的最小值及其索引
            var minH = Math.min.apply(null, hArr);
            var minHIndex = $.inArray(minH, hArr);
            // 左边位置为盒子宽度*列数+第一列到左边距的距离
            $(value).css({
                'position': 'absolute',
                'top': minH,
                'left': boxW * minHIndex + $boxs.eq(0).offset().left
            });
            // 更新数组
            hArr[minHIndex] += thisH;
            // 动态改变mainbody高度
            $('.mainbody').height(Math.max.apply(null, hArr));
        }
    });
}

// 检查是否需要加载图片
function checkScrollSlide() {
    // （滚动高度+当前可视高度）/ 总高度 >= 0.85 即滚动到总界面的85%时加载
    return ($(document).scrollTop()+$(window).height())/$(document).height() >= 0.85 ? true:false;
}

function showLightbox(picSrc) {
    $('.lightbox-btn').fadeOut();
    $('.lightbox-close-btn').fadeOut();
    $('.lightbox-img').fadeOut();
    $('.lightbox-wrap').fadeIn();
    var lightbox = $('.lightbox');
    lightbox.fadeIn();
    var winW = $(window).width();
    var winH = $(window).height();
    // 设置幕布大小
    $('.lightbox-view').css({
        width:winW/2,
        height:winH/2
    });
    // 设置幕布位置
    lightbox.css({
        width:winW/2+10,
        height:winH/2+10,
        left:(winW/2+10)/2,
        top:-(winH/2+10)
    }).animate({
        top:(winH/2+10)/2
    }, function() {
        // 加载图片
        loadPic(picSrc);
    });
}

function loadPic(picSrc) {
    preLoadPic(picSrc, function() {
        var lightbox_img = $('.lightbox-img');
        lightbox_img.attr('src',picSrc);
        var picW = lightbox_img.width(),
            picH = lightbox_img.height();
            // console.log(picW+" : "+picH);
    });
}

// 预加载图片
function preLoadPic(picSrc,callback) {
    var img = new Image();
    img.src = picSrc;
    if(!!window.ActiveXObject) {
        img.onreadystatechange = function() {
            if (this.readyState == "complete") {
                callback();
            }
        }
    } else {
        img.onload = function() {
            callback();
        }
    }

}
