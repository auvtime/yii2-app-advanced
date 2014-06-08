$(document).ready(function() {
	//ajax上传图片
	 $('#fileupload').fileupload({  
	    dataType: 'json',  
	    url: '/my/upload-face',          
	    success: function (json) {            
	    	$("#userFaceOrig").attr('src',json.upfile.file);  
	    }  
	});  

	
	var cropzoom = $('#cropzoom_container').cropzoom({
		width : 500,
		height : 360,
		bgColor : '#ccc',
		enableRotation : true,
		enableZoom : true,
		selector : {
			w : 150,
			h : 200,
			showPositionsOnDrag : true,
			showDimetionsOnDrag : false,
			centered : true,
			bgInfoLayer : '#fff',
			borderColor : 'blue',
			animated : false,
			maxWidth : 150,
			maxHeight : 200,
			borderColorHover : 'yellow'
		},
		image : {
			source : 'http://www.js-css.cn/jscode/focus/focus19/images/b2.jpg',
			width : 450,
			height : 300,
			minZoom : 30,
			maxZoom : 150
		}
	});
	$("#crop").click(function() {
		cropzoom.send('resize_and_crop.php', 'POST', {}, function(imgRet) {
			$("#generated").attr("src", imgRet);
		});
	});
	$("#restore").click(function() {
		$("#generated").attr("src", "tmp/head.gif");
		cropzoom.restore();
	});
});