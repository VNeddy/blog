$(document).ready(function() {
    /**
     * 留言弹出层
     */


     var id;

    //触发弹出层
    $('.replay').on('click', function() {
            $('.login-layer-wrap').fadeIn();
            // 获得当前留言的id
            id = $(this).attr('id');
    });

    //点击或者触控弹出层外的半透明遮罩层，关闭弹出层
    $('.login-layer-wrap').on('click', function(event) {
        if (event.target == this) {
            $(this).fadeOut();
        }
    });

    $('.cancel').on('click', function() {
        $('.login-layer-wrap').fadeOut();
        // 点击取消，隐藏游客信息弹出层，并刷新页面
        // location.reload(true);
    });


    /**
     * 通过Ajax提交留言表单
     */

    //此标志用于标志是否提交，防止多次提交
    var flag = false;
    //监测是否提交
    $('#replay_message').submit(function(e) {
        //阻止表单的自动提交
        e.preventDefault();
        if (flag) return false;
        flag = true;
        $('.ok').val('确认...');
        $('span.error').remove();
        //通过Ajax发送数据
        $.post('article.replay.handle.php?id='+id, $(this).serialize(), function(msg) {

            flag = false;
            $('.ok').val('确认');

            if (msg.status) {
                // 留言成功后，隐藏弹出层，清空表单
                $('.login-layer-wrap').fadeOut();
                $('#replay_content').val('');
                location.reload();
            } else {
                $.each(msg.errors, function(k, v) {
                    $('label[for=' + k + ']').after('<span class="error">' + v + '</span>');
                });
            }
        }, 'json');
    });
});
