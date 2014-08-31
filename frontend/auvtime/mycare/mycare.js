//关闭添加窗口
function closeCreatePage(){
	$('#addMyCare').msgbox().close();
}
function closeUpdatePage(){
	$.msgbox().close();
}
//LYQ represents "留言墙"
var LYQ = {
	line : 4,
	width : 250
};
//动态加载我关心的人
function loadMyCareList(){
	$.ajax({
		url:'/my-care/care-list',
		success:function(data){
			$('#my-care-list').html(data);
			LYQ.run();
			$('.xubox_layer').draggable({ containment: ".my-care-index" });
		}
	});
}

(function(L) {
	
	LYQ._class = [ 'yellow', 'green', 'blue', 'color4' ];

	LYQ.view = function(index, value, othis) {
		var nos = Math.floor(Math.random() * 4), left, fade;
		L(othis).addClass(this._class[nos]);
		L.layer({
			type : 1,
			page : {
				dom : othis
			},
			fix : false,
			area : [ '180px', 'auto' ],
			offset : [ '100px', '260px' ],
			zIndex : layer.zIndex,
			move : [ '.ly_titleTxt', true ],
			shade : [ 0 ],
			bgcolor : '',
			title : false,
			closeBtn : false,
			border : [ 0 ],
			success : function(layerE) {
				var _e = Math.ceil((index + 1) / LYQ.line) - 1, time, lLen = L('.xubox_layer').length;
				if (index > (LYQ.line - 1)) {
					var left = 50 + LYQ.width * (index - LYQ.line * _e), extop, nlayer = L(
							'.xubox_layer').eq(index - LYQ.line);
					!-[ 1, ] ? extop = nlayer.offset().top + 30
							: extop = 20 * _e + 100 * _e;
					var top = nlayer.outerHeight() + extop;
				} else {
					var left = 50 + LYQ.width * index;
				}
				!-[ 1, ] ? time = 0 : 500;
				var mate = {
					left : left,
					top : top,
					marginLeft : 0
				};
				if (!-[ 1, ]) {
					layerE.hide().animate(mate, time);
					index === lLen - 1 && layerE.show();
				} else {
					layerE.animate(mate, time);
				}
				layer.setTop(layerE);
			}
		});
	};

	LYQ.run = function() {
		var li = L('#my-care-list>.liuyan>li');
		L.each(li, function(index, value) {
			LYQ.view(index, value, this);
		});
	};
	L.msgbox.defaults({
		overlayEvent: 'close',
		resize: false,
		lang: 'zh_CN',
		opacity:.5,
		zIndex:99999999
	});
	//添加我关心的人
	L('#addMyCare').msgbox({
		type:'iframe',
		content: '/my-care/create'
	});
	
	loadMyCareList();
	//上下文菜单
	L('#my-care-list').on('mouseover','.ly_list',function(){
		L(this).find('.context-menu>.menu').css('visibility','visible');
	}).mouseout(function(){
		L(this).find('.context-menu>.menu').css('visibility','hidden');
	});
	//删除菜单
	L('#my-care-list').on('click','.del-menu',function(){
		var careId = L(this).parent().attr('care-data');
		L.msgbox({
			type: 'confirm',
			content: '你确定要删除吗?',
			title: '删除提示!',
			onClose: function(){
				//如果确定，则删除，重新加载所有人
				if(this.val()){
					var delUrl = '/my-care/delete';
					$.post(delUrl, {
						'careId':careId
					},function(message){
						loadMyCareList();
					});
				}
			}
		});
	});
	//删除菜单
	L('#my-care-list').on('click','.edit-menu',function(e){
		var careId = L(this).parent().attr('care-data');
		L.msgbox({
			type:'iframe',
			content: '/my-care/update?careId=' + careId
		});
	});
})($);

