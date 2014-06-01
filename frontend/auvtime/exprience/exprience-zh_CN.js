$(document).ready(function(){
	$('#experience-exp_time').click(function(){
		WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});
	});
});
function submitForm($form) {
	$.post($form.attr("action"), $form.serialize()).done(function(result) {
		//首先清空输入内容
		$('#experience-exp_time').val('');
		$('#experience-content').val('');
		//移除提示框
		$('#noDataFound').remove();
		//动态添加到列表中
		var exprience = eval('(' + result.message + ')');
		var content = exprience.content;
		var createTime = exprience.create_time;
		var expTime = exprience.exp_time;
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