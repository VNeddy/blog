$(document).ready(function() {
    //此标志用于标志是否提交，防止多次提交
	var flag=false;
	//监测是否提交
	$('#add-pic').submit(function(e){
		//阻止表单的自动提交
 		e.preventDefault();
		if(flag) return false;
		flag = true;
		$('#submit').val('上传...');
		$('span.error').remove();
		//通过Ajax发送数据
		$.ajax({
            url: 'photo.upload.php',
            type: 'POST',
            cache: false,
            dataType: 'json',
            data: new FormData($('#add-pic')[0]),
            processData: false,
            contentType: false,
            success: function(msg){

    			flag = false;
    			$('#submit').val('上传照片');

    			if(msg.status){
    				location.href = 'photo.manage.php';
    			} else {
    				$.each(msg.errors,function(k,v){
    					$('label[for='+k+']').after('<span class="error">'+v+'</span>');
    				});
    			}
    		}
        });
    });
});
