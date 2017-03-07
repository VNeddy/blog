$(document).ready(function(){
    waterFall();
    // 模拟后台数据
    var dataInt = {"data": [{"src": "gallery-item-1.jpg"}, {"src": "gallery-item-2.jpg"}, {"src": "gallery-item-3.jpg"}, {"src": "gallery-item-4.jpg"}, {"src": "gallery-item-5.jpg"}, {"src": "gallery-item-6.jpg"}, {"src": "gallery-item-7.jpg"}, {"src": "gallery-item-8.jpg"}]};
    $(window).scroll(function(){
        if (checkScrollSlide()) {
            $.each(dataInt.data, function(index, value) {
                var oBox = $('<div>').addClass('box').appendTo($('.mainbody'));
                var oPic = $('<div>').addClass('pic').appendTo($(oBox));
                $('<img>').attr('src', 'img/gallery/' + value.src).appendTo(oPic);
            });
            waterFall();
        }
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

function checkScrollSlide() {
    var $lastbox = $(".mainbody").find('.box').last();
    var lastboxH = $lastbox.offset().top + $lastbox.outerHeight();
    var scrollTop = $(window).scrollTop();
    var documentH = $(window).height();
    return lastboxH < (scrollTop + documentH)?true:false;
}
