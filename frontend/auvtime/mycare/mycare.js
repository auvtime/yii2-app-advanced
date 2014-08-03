(function(L) {
	//LYQ represents "留言墙"
	var LYQ = {
		line : 4,
		width : 250
	};
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
		var li = L('.liuyan>li');
		L.each(li, function(index, value) {
			LYQ.view(index, value, this);
		});
	};

	if (-[ 1, ]) {
		LYQ.run();
	} else {
		L(document).ready(function() {
			layer.msg('IE浏览器查看效果将会不佳    您可以选择chrome或者firefox等浏览器访问该页面', 2, 13,
					function() {
						layer.msg('您可以选择chrome或者firefox等浏览器访问该页面', 2, 8,
								function() {
									LYQ.run();
								});

					});
		});
	}
	
	L('.xubox_layer').draggable({ containment: ".my-care-index" });

})($);
