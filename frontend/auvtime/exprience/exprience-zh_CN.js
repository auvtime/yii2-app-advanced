$(document).ready(function(){
	$('#experience-exp_time').click(function(){
		WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});
	});
	//鼠标移动到显示区域的时候显示下拉菜单
	$('.experience-list').on('mouseover','.experience',function(){
		$(this).find('.exp-menu>.dropdown>.exp-menu-icon-choose,.exp-menu>.dropdown>.dropdown-menu').css('visibility','visible');
	}).mouseout(function(){
		$(this).find('.exp-menu>.dropdown>.exp-menu-icon-choose,.exp-menu>.dropdown>.dropdown-menu').css('visibility','hidden');
	});
	//右上角下拉菜单
	$('.exp-menu-button').dropdown();
	$('.dropdown').on('shown.bs.dropdown',function(){
		$(this).find('.exp-menu-button').removeClass('exp-menu-icon-choose').addClass('exp-menu-icon-choose-up');
	}).on('hidden.bs.dropdown',function(){
		$(this).find('.exp-menu-button').removeClass('exp-menu-icon-choose-up').addClass('exp-menu-icon-choose');
	});
	//状态栏
	function hideStatus(sec){
		window.setTimeout(function(){
			$('#statusMsg').find('span').hide().remove();
		},sec);
	}
	//删除经历和记入成就按钮
	$('.experience-list').on('click','.experience>.exp-menu>.dropdown>.dropdown-menu>li>a',function(){
		var $dropdownMenu = $(this).parent().parent().parent();
		var eId = $dropdownMenu.find('a').attr('exp-data');
		var menuType = $(this).attr('menu-type');
		if(menuType == 'delete-exp'){
			$('#dTip').html('你确定要删除此条经历吗?').removeClass('alert alert-danger');
			$('#dDialog').dialog({
				 resizable: false,
				 height:170,
				 modal:true,
				 open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
				 buttons: {
					 "确定": function() {
						 $.post('/experience/delete',{
							 'eid':eId
						 }).success(function(message){
							 if('success' == message){
								 $('#dDialog').dialog('close');
								 //删除页面上的此条经历
								 var $experience = $dropdownMenu.parent().parent();
								 $experience.slideUp('slow',function(){
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
		}else if(menuType == 'add-to-ach'){
			$('#aTip').html('确定要把此条经历记入成就吗?').removeClass('alert alert-danger');
			$('#aDialog').dialog({
				 resizable: false,
				 height:215,
				 modal:true,
				 open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
				 buttons: {
					 "确定": function() {
						 $.post('/experience/add-to-ach',{
							 'eid':eId
						 }).success(function(result){
							 var message = eval('(' + result + ')');
							 if(message.flag == 'success'){
								 $('#aDialog').dialog( "close" );
								 $('#statusMsg').html(message.msg).show();
								 hideStatus(2000);
							 }else{
								 $('#aTip').html(message.msg).addClass('alert alert-danger');
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
	//设置头像
	var faceUrl = $('#faceUrl').val();
	if(faceUrl != ''){
		$('.face').css('background','url(' + faceUrl + ')');
	}
	var pageCount = $('#pageCount').val();
	//滚动条滚动到页面底部自动加载更多
	$('#myExperiences').infinitescroll({
		navSelector  	: "#loadMore",
		nextSelector 	: "#loadMore #nextPage:last",
		itemSelector 	: ".experience",
		dataType	 	: 'json',
        maxPage         : pageCount,
        loading: {
    		finished: undefined,
    		finishedMsg: "没有更多的经历了！",
    		msgText: "正在加载更多经历...",
    		speed: 'fast',
    	},
        appendCallback: false
    }, function(json, opts){
    	var $loadMorePlace = $('#loadMore');
    	$.each(json,function(index,exprience){
    		var content = exprience.content;
			var createTime = '创建时间:' + exprience.create_time;
			var expTime = '经历时间：' + exprience.exp_time;
			var expId = exprience.id;
			var $expTemplate = $('#exp-template');
			$expTemplate.find('.exp-menu-button').attr('exp-data',expId);
			var $expDetail = $expTemplate.find('.exp-detail');
			$expDetail.find('.content').html(content);
			$expDetail.find('.create-time').html(createTime);
			$expDetail.find('.exp-time').html(expTime);
			var $exp = $expTemplate.clone();
			$exp.attr('id', Math.random());
			$exp.css('display', 'none');
			$exp.insertBefore($loadMorePlace).slideDown();
    	});
	});
	//返回顶部
	$(window).backToTop({
		showHeight : 500,//设置滚动高度时显示
		speed : 100 //返回顶部的速度以毫秒为单位
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
					if(timer >= 10){
						timer = 0;
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
				var expId = exprience.id;
				var $expTemplate = $('#exp-template');
				$expTemplate.find('.exp-menu-button').attr('exp-data',expId);
				var $expDetail = $expTemplate.find('.exp-detail');
				$expDetail.find('.content').html(content);
				$expDetail.find('.create-time').html(createTime);
				$expDetail.find('.exp-time').html(expTime);
				var $exp = $expTemplate.clone();
				$exp.attr('id', Math.random());
				$exp.css('display', 'none');
				$exp.insertAfter($expTemplate).slideDown('slow');
			}).fail(function() {

			});
			return false;
		}
	});
	return false;
}