$(function() {
	var cropzoom = $('#cropzoom_container').cropzoom({
		width : 500,// DIV层宽度
		height : 360,// DIV层高度
		bgColor : '#ccc',// DIV层背景颜色
		enableRotation : true,// 是否允许旋转图片true false
		enableZoom : true,// 是否允许放大缩小
		selector : {
			w : 110,// 选择器宽度
			h : 110,// 旋转高度
			showPositionsOnDrag : true,// 是否显示拖拽的位置洗洗脑
			showDimetionsOnDrag : false,
			centered : true,// 居中
			bgInfoLayer : '#fff',
			borderColor : 'blue',// 选择区域边框样式
			animated : false,
			maxWidth : 110,// 最大宽度
			maxHeight : 110,// 最大高度
			borderColorHover : 'yellow'// 鼠标放到选择器的边框颜色
		},
		image : {
			source : '/images/face/init.jpg',
			width : 450,// 图片宽度
			height : 300,// 图片高度
			minZoom : 30,// 最小放大比例
			// 最大放大比例
			maxZoom : 150
		}
	});
	$("#crop").click(function() {// 裁剪提交
		cropzoom.send('crop-face', 'POST', {}, function(imgRet) {
			$("#generated").attr("src", imgRet);
		});
	});
	$("#restore").click(function() {// 显示初始状态照片
		$("#generated").attr("src", "tmp/head.gif");
		cropzoom.restore();
	});
	$('#fileupload').fileupload({
		dataType : 'json',
		add : function(e, data) {
			data.submit();
		},
		done : function(e, data) {
			$('#progress .bar').html('上传完成,请裁剪你的头像.');
			$.each(data.result.files, function(index, file) {
				cropzoom = $('#cropzoom_container').cropzoom({
					width : 500,// DIV层宽度
					height : 360,// DIV层高度
					bgColor : '#ccc',// DIV层背景颜色
					enableRotation : true,// 是否允许旋转图片true false
					enableZoom : true,// 是否允许放大缩小
					selector : {
						w : 110,// 选择器宽度
						h : 110,// 旋转高度
						showPositionsOnDrag : true,// 是否显示拖拽的位置洗洗脑
						showDimetionsOnDrag : false,
						centered : true,// 居中
						bgInfoLayer : '#fff',
						borderColor : 'blue',// 选择区域边框样式
						animated : false,
						maxWidth : 110,// 最大宽度
						maxHeight : 110,// 最大高度
						borderColorHover : 'yellow'// 鼠标放到选择器的边框颜色
					},
					image : {
						source : file.url,
						width : 450,// 图片宽度
						height : 300,// 图片高度
						minZoom : 30,// 最小放大比例
						// 最大放大比例
						maxZoom : 150
					}
				});
			});
		},
		progressall : function(e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			var $progressBar = $('#progress .bar');
			$progressBar.addClass('alert alert-success');
			$progressBar.html(progress + '%');
			$progressBar.css('width', progress + '%');
		}
	});
});