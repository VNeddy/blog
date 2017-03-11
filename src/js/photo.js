var lightboxData = [];  // 存放图片信息
var picSrc;     // 存放图片地址

$(document).ready(function(){
    var timer = setInterval(waterFall,100);
    var number = 0;
    var flag = true;
    //将已经加载的图片存到lightboxData中
    var $box = $('.box');
    $.each($box, function(index,value) {
        var existImgSrc = $(value).find('img').attr('src');
        lightboxData.push(existImgSrc);
    });
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
                            // 将动态加载的图片存到lightboxData中
                            lightboxData.push(value.url);
                            // 数组改变后，重新加载
                            showLightboxBtn();
                            changeLightboxIndex();
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
    $(document.body).delegate(".js-lightbox","click",function(e) {
        // 阻止事件冒泡
        e.stopPropagation();
        picSrc = $(this).attr('src');
        // 弹出幕布并加载图片
        showLightbox();
    });

    // 点击遮罩层或关闭按钮隐藏大图
    $('.lightbox-wrap,.lightbox-close-btn').on("click",function(e) {
        // 阻止事件冒泡
        e.stopPropagation();
        $('.lightbox-wrap').fadeOut();
        $('.lightbox').fadeOut();
        // 解除滚动条锁定
        // $(document.body).css({"overflow":"visible"});
    });

    // 鼠标移动到上一张/下一张的效果
    $('.lightbox-btn-prev').hover(function() {
        $(this).addClass('lightbox-btn-prev-show');
    }, function() {
        $(this).removeClass('lightbox-btn-prev-show');
    });
    $('.lightbox-btn-next').hover(function() {
        $(this).addClass('lightbox-btn-next-show');
    }, function() {
        $(this).removeClass('lightbox-btn-next-show');
    });

    // 点击上一张/下一张效果
    $('.lightbox-btn-next').on("click",function(e) {
        e.stopPropagation();
        // loadPic(lightboxData[currentIndex+1]);
        var currentIndex = $.inArray(picSrc,lightboxData);
        picSrc = lightboxData[currentIndex+1];
        loadPic();
    });
    $('.lightbox-btn-prev').on("click",function(e) {
        e.stopPropagation();
        // loadPic(lightboxData[currentIndex-1]);
        var currentIndex = $.inArray(picSrc,lightboxData);
        picSrc = lightboxData[currentIndex-1];
        loadPic();
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

function showLightbox() {
    // $('.lightbox-btn').fadeOut();
    $('.lightbox-img').fadeOut();
    $('.lightbox-index').fadeOut();
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
        marginLeft:-(winW/2+10)/2,
        top:-(winH/2+10)
    }).animate({
        top:(winH/2+10)/2
    }, function() {
        // 加载图片
        loadPic();
    });
}

// 加载图片
function loadPic() {
    $('.lightbox-index').hide();
    // 取消上一次的图片尺寸
    $('.lightbox-img').css({
        height: 'auto',
        width: 'auto',
    }).hide();
    preLoadPic(function() {
        var lightbox_img = $('.lightbox-img');
        // 更改图片路径
        lightbox_img.attr('src',picSrc);
        // 获取加载图片尺寸
        var picW = lightbox_img.width(),
            picH = lightbox_img.height();
            // console.log(picW+":"+picH);
        changePic(picW,picH);
    });
}

// 改变图片大小
function changePic(picW,picH) {
    var winH = $(window).height(),
        winW = $(window).width();

    // 如果图片宽高大于浏览器的宽高，按比例调整
    var scale = Math.min(winW/(picW+10),winH/(picH+10),1);

    picW *= scale;
    picH *= scale;

    $('.lightbox-view').animate({
        width: picW-10,
        height: picH-10,
    });

    $('.lightbox').animate({
        width:picW,
        height:picH,
        marginLeft:-(picW/2),
        top: (winH-picH)/2
    },function() {
        $('.lightbox-img').css({
            width: picW-10,
            height: picH-10,
        }).fadeIn();
        changeLightboxIndex();
        showLightboxBtn(picSrc);
    });
}

// 改变图片索引
function changeLightboxIndex() {
    var lightboxIndex = $('.lightbox-index');
    var currentIndex = $.inArray(picSrc,lightboxData) + 1;
    lightboxIndex.find('span').html('当前索引：'+currentIndex+' of '+lightboxData.length);
    lightboxIndex.fadeIn();
}

// 预加载图片
function preLoadPic(callback) {
    var img = new Image();
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
    img.src = picSrc;

}

// 实现上下切换图片按钮
function showLightboxBtn() {
    $('.lightbox-btn').fadeIn();
    var currentIndex = $.inArray(picSrc,lightboxData);
    if(lightboxData[currentIndex+1] == null) {
        $('.lightbox-btn-next').fadeOut();
    }
    if(currentIndex == 0) {
        $('.lightbox-btn-prev').fadeOut();
    }
    // 放在这里会启动多个点击事件
    // $('.lightbox-btn-next').on("click",function(e) {
    //     e.stopPropagation();
    //     // loadPic(lightboxData[currentIndex+1]);
    //     console.log(lightboxData[currentIndex+1]);
    // });
    // $('.lightbox-btn-prev').on("click",function(e) {
    //     e.stopPropagation();
    //     loadPic(lightboxData[currentIndex-1]);
    // });
}
