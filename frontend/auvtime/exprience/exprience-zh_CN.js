$(document).ready(function(){
	$('#experience-exp_time').click(function(){
		WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});
	});
});
//定时器初始化为0
var timer = 0;
var saveTimer;
function submitForm($form) {
	var createUrl = $form.attr("action");
	var createData = $form.serialize();
	//设定一个计时器，如果用户保存过于频繁，则给出提示
	if(timer == 10){
		if(saveTimer){
			window.clearInterval(saveTimer);
		}
	}else if(timer > 0){
		$('#restmodal').modal('show');
		return false;
	}
	//检测内容是否相同
	var expTime = $('#experience-exp_time').val();
	var content = $('#experience-content').val();
	$.post('/experience/content-exists',{
		'ExperienceSearch':{
			'exp_time':expTime,
			'content':content
		}
	}).success(function(result){
		if(result == 'exists'){
			$('#contentmodal').modal('show');
			return false;
		}else{
			//提交保存
			$.post(createUrl, createData).success(function(result) {
				saveTimer = window.setInterval(function(){
					timer ++;
					if(timer == 10){
						window.clearInterval(saveTimer);
					}
				},1000);
				//首先清空输入内容
				$('#experience-exp_time').val('');
				$('#experience-content').val('');
				//移除提示框
				$('#noDataFound').remove();
				//动态添加到列表中
				var exprience = eval('(' + result.message + ')');
				var content = exprience.content;
				var createTime = '创建时间:' + exprience.create_time;
				var expTime = '经历时间：' + exprience.exp_time;
				var $expTemplate = $('#exp-template');
				var $expDetail = $expTemplate.find('.exp-detail');
				$expDetail.find('.content').html(content);
				$expDetail.find('.create-time').html(createTime);
				$expDetail.find('.exp-time').html(expTime);
				var $exp = $expTemplate.clone();
				$exp.attr('id', Math.random());
				$exp.css('display', 'block');
				$exp.insertAfter($expTemplate).fadeIn('slow');
			}).fail(function() {

			});
			return false;
		}
	});
	return false;
}