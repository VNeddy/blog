$(document).ready(function() {
    /**
     * 留言弹出层
     */

    //触发弹出层
    $('#message-button').on('click', function() {
        if ($('#message-content').val() === '') {
            $('.is-empty-wrap').fadeIn();
        } else {
            $('.login-layer-wrap').fadeIn();
        }
    });

    //点击或者触控弹出层外的半透明遮罩层，关闭弹出层
    $('.login-layer-wrap').on('click', function(event) {
        if (event.target == this) {
            $(this).fadeOut();
        }
    });

    $('.is-empty-wrap').on('click', function(event) {
        if (event.target == this) {
            $(this).fadeOut();
        }
    });

    $('.cancel').on('click', function() {
        $('.login-layer-wrap').fadeOut();
        // 点击取消，隐藏游客信息弹出层，并刷新页面
        // location.reload(true);
    });

    $('.is-empty-btn').on('click', function() {
        $('.is-empty-wrap').fadeOut();
    });


    /**
     * 通过Ajax提交留言表单
     */

    //此标志用于标志是否提交，防止多次提交
    var flag = false;
    //监测是否提交
    $('#add-message').submit(function(e) {
        //阻止表单的自动提交
        e.preventDefault();
        if (flag) return false;
        flag = true;
        $('.ok').val('确认...');
        $('span.error').remove();
        //通过Ajax发送数据
        $.post('message.add.handle.php', $(this).serialize(), function(msg) {

            flag = false;
            $('.ok').val('确认');

            if (msg.status) {
                // 留言成功后，隐藏弹出层，清空表单
                $('.login-layer-wrap').fadeOut();
                $('#message-content').val('');
                $('#tmpuser').val('');
                // 无刷新显示留言
                // 判断是否是第一条
                if ($('.comment-wrap').find('p').length > 0) {
                    // 是第一条删除信息后显示
                    $('.comment-wrap').find('p').remove();
                    $(msg.html).hide().insertBefore('#insert').slideDown();
                } else {
                    // 不是第一条直接显示
                    $(msg.html).hide().insertBefore('#insert').slideDown();
                }
            } else {
                $.each(msg.errors, function(k, v) {
                    $('label[for=' + k + ']').after('<span class="error">' + v + '</span>');
                });
            }
        }, 'json');
    });
});
