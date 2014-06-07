$(document).ready(function(){
	$('#achievement-achieve_time').click(function(){
		WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});
	});
	//鼠标移动到显示区域的时候显示下拉菜单
	$('.achievement-list').on('mouseover','.achievement',function(){
		$(this).find('.ach-menu>.dropdown>.ach-menu-icon-choose,.ach-menu>.dropdown>.dropdown-menu').css('visibility','visible');
	}).mouseout(function(){
		$(this).find('.ach-menu>.dropdown>.ach-menu-icon-choose,.ach-menu>.dropdown>.dropdown-menu').css('visibility','hidden');
	});
	//右上角下拉菜单
	$('.ach-menu-button').dropdown();
	$('.dropdown').on('shown.bs.dropdown',function(){
		$(this).find('.ach-menu-button').removeClass('ach-menu-icon-choose').addClass('ach-menu-icon-choose-up');
	}).on('hidden.bs.dropdown',function(){
		$(this).find('.ach-menu-button').removeClass('ach-menu-icon-choose-up').addClass('ach-menu-icon-choose');
	});
	//删除经历和记入成就按钮
	$('.achievement-list').on('click','.achievement>.ach-menu>.dropdown>.dropdown-menu>li>a',function(){
		var $dropdownMenu = $(this).parent().parent().parent();
		var aId = $dropdownMenu.find('a').attr('ach-data');
		var menuType = $(this).attr('menu-type');
		if(menuType == 'delete-ach'){
			$('#dTip').html('你确定要删除此条成就吗?').removeClass('alert alert-danger');
			$('#dDialog').dialog({
				 resizable: false,
				 height:170,
				 modal:true,
				 open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
				 buttons: {
					 "确定": function() {
						 $.post('/achievement/delete',{
							 'aid':aId
						 }).success(function(message){
							 if('success' == message){
								 $('#dDialog').dialog('close');
								 //删除页面上的此条经历
								 var $achievement = $dropdownMenu.parent().parent();
								 $achievement.slideUp('slow',function(){
									$(this).remove();
								 });
							 }else{
								 $('#dTip').html(message).addClass('alert alert-danger');
							 }
						 });
					 },
					 '取消': function() {
						 $( this ).dialog( "close" );
					 }
				 }
			});
		}
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
	var achieveTime = $('#achievement-achieve_time').val();
	var content = $('#achievement-content').val();
	$.post('/achievement/content-exists',{
		'AchievementSearch':{
			'achieve_time':achieveTime,
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
					if(timer >= 10){
						timer = 0;
						window.clearInterval(saveTimer);
					}
				},1000);
				//首先清空输入内容
				$('#achievement-achieve_time').val('');
				$('#achievement-content').val('');
				//移除提示框
				$('#noDataFound').remove();
				//动态添加到列表中
				var achievement = eval('(' + result.message + ')');
				var content = achievement.content;
				var createTime = '创建时间:' + achievement.create_time;
				var achTime = '成就时间：' + achievement.achieve_time;
				var achId = achievement.id;
				var $achTemplate = $('#ach-template');
				$achTemplate.find('.ach-menu-button').attr('ach-data',achId);
				var $achDetail = $achTemplate.find('.ach-detail');
				$achDetail.find('.content').html(content);
				$achDetail.find('.create-time').html(createTime);
				$achDetail.find('.ach-time').html(achTime);
				var $ach = $achTemplate.clone();
				$ach.attr('id', Math.random());
				$ach.css('display', 'none');
				$ach.insertAfter($achTemplate).slideDown('slow');
			}).fail(function() {

			});
			return false;
		}
	});
	return false;
}