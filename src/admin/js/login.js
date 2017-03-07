$(document).ready(function(){
    /**
     * 注册界面验证码刷新
     */
    /**
     * 由于浏览器会对同一url的图像进行缓存，减少向服务器端的请求次数
     * 因此加上随机数以确保url不同，使浏览器重新加载验证码
     * 实现验证码的局部刷新
     */
    $('#code').on('click', function() {
        $(this).attr('src', 'code.php?tm=' + Math.random());
    });

    //此标志用于标志是否提交，防止多次提交
	var flag=false;
	//监测是否提交
	$('#login').submit(function(e){
		//阻止表单的自动提交
 		e.preventDefault();
		if(flag) return false;
		flag = true;
		$('#submit').val('登录...');
		$('span.error').remove();
		//通过Ajax发送数据
		$.post('login.php?action=login',$(this).serialize(),function(msg){

			flag = false;
			$('#submit').val('登录');

			if(msg.status){
				location.href = 'index.php';
			}
			else {
                $('#code').attr('src','code.php?tm=' + Math.random());
				$.each(msg.errors,function(k,v){
					$('label[for='+k+']').after('<span class="error">'+v+'</span>');
				});
			}
		},'json');
	});
});
