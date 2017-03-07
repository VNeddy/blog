$(document).ready(function(){
	//此标志用于标志是否提交，防止多次提交
	var flag=false;
	/**
	 * 添加文章
	 */
	//监测是否提交
	$('#add-article').submit(function(e){
		//阻止表单的自动提交
 		e.preventDefault();
		if(flag) return false;
		flag = true;
		$('#submit').val('发布...');
		$('span.error').remove();
		//通过Ajax发送数据
		$.post('article.add.handle.php',$(this).serialize(),function(msg){

			flag = false;
			$('#submit').val('发布文章');

			if(msg.status){
                alert('发布成功');
				location.reload(true);
			}
			else {
				$.each(msg.errors,function(k,v){
					$('label[for='+k+']').after('<span class="error">'+v+'</span>');
				});
				alert("发布失败");
			}
		},'json');
	});

	/**
	 * 修改文章
	 */
	//监测是否提交
	$('#modify-article').submit(function(e){
		//阻止表单的自动提交
 		e.preventDefault();
		if(flag) return false;
		flag = true;
		$('#submit').val('修改...');
		$('span.error').remove();
		//通过Ajax发送数据
		$.post('article.modify.handle.php',$(this).serialize(),function(msg){

			flag = false;
			$('#submit').val('修改文章');

			if(msg.status){
                alert('修改成功');
				location.reload(true);
			}
			else {
				$.each(msg.errors,function(k,v){
					$('label[for='+k+']').after('<span class="error">'+v+'</span>');
				});
				alert("修改失败");
			}
		},'json');
	});

	/**
	 * 添加说说
	 */
	 //监测是否提交
 	$('#add-gossip').submit(function(e){
 		//阻止表单的自动提交
  		e.preventDefault();
 		if(flag) return false;
 		flag = true;
 		$('#submit').val('发布...');
 		$('span.error').remove();
 		//通过Ajax发送数据
 		$.post('gossip.add.handle.php',$(this).serialize(),function(msg){

 			flag = false;
 			$('#submit').val('发布说说');

 			if(msg.status){
                 alert('发布成功');
 				location.reload(true);
 			}
 			else {
 				$.each(msg.errors,function(k,v){
 					$('label[for='+k+']').after('<span class="error">'+v+'</span>');
 				});
				alert("发布失败");
 			}
 		},'json');
 	});

	/**
	 * 修改说说
	 */
	 //监测是否提交
 	$('#modify-gossip').submit(function(e){
 		//阻止表单的自动提交
  		e.preventDefault();
 		if(flag) return false;
 		flag = true;
 		$('#submit').val('修改...');
 		$('span.error').remove();
 		//通过Ajax发送数据
 		$.post('gossip.modify.handle.php',$(this).serialize(),function(msg){

 			flag = false;
 			$('#submit').val('修改说说');

 			if(msg.status){
                 alert('修改成功');
 				location.reload(true);
 			}
 			else {
 				$.each(msg.errors,function(k,v){
 					$('label[for='+k+']').after('<span class="error">'+v+'</span>');
 				});
				alert("修改失败");
 			}
 		},'json');
 	});

	/**
	 * 发布个人简介
	 */
	 //监测是否提交
 	$('#add-about').submit(function(e){
 		//阻止表单的自动提交
  		e.preventDefault();
 		if(flag) return false;
 		flag = true;
 		$('#submit').val('发布...');
 		$('span.error').remove();
 		//通过Ajax发送数据
 		$.post('about.add.handle.php',$(this).serialize(),function(msg){

 			flag = false;
 			$('#submit').val('发布介绍');

 			if(msg.status){
                 alert('发布成功');
 				location.reload(true);
 			}
 			else {
 				$.each(msg.errors,function(k,v){
 					$('label[for='+k+']').after('<span class="error">'+v+'</span>');
 				});
				alert("发布失败");
 			}
 		},'json');
 	});

});
