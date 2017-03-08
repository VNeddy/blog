$(document).ready(function(){
    var number = 0;
    var flag = true;
    $(window).on('scroll', function(){
        if (checkScrollSlide() && flag) {
            number++;
            $.ajax({
                type: "GET",
                url: "gossip.php?number=" + number,
                async: false,
                dataType: "json",
                success: function(dataInt) {
                    if (dataInt.status) {
                        $.each(dataInt.data, function(index, value) {
                            var oBox = $('<div>').addClass('gossip').appendTo($('.mainbody'));
                            var oP = $('<p>').html(value.content).appendTo($(oBox));
                            $('<span>').addClass('data-view').html(value.pubTime).appendTo(oP);
                        });
                    } else {
                        flag = false;
                    }
                },
            });
        }
    });
});


// 检查是否需要加载说说
function checkScrollSlide() {
    // （滚动高度+当前可视高度）/ 总高度 >= 0.95 即滚动到总界面的95%时加载
    return ($(document).scrollTop()+$(window).height())/$(document).height() >= 0.95 ? true:false;
}
