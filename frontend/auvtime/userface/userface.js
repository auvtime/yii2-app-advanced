$(function() {
    $('#fileupload').fileupload({
        dataType : 'json',
        add : function(e, data) {
        	//隐藏进度条
        	//$('#progress .bar').removeClass('show').addClass('hidden');
        	//首先判断用户是否已选文件，如果已经选择了文件，则提示用户不要再进行选择
        	var $userFaceFileName = $('#userfacefilename');
            data.context = $('#fileuploadBtn').removeClass('hidden').addClass('show').click(function() {
            	$(this).val('上传中...');
            	var jqXHR = data.submit().success(function (result, textStatus, jqXHR) {
            		
                }).error(function (jqXHR, textStatus, errorThrown) {
                	
                }).complete(function (result, textStatus, jqXHR) {
                	
                });
            });
            $.each(data.files, function (index, file) {
                var node = $('<p/>').append($('<span/>').text(file.name));
                node.appendTo($userFaceFileName);
            });
        },
        done : function(e, data) {
            $.each(data.result.files, function(index, file) {
            	$('#fileuploadBtn').val('上传头像');
            	$('#progress').addClass('hidden');
            });
        },
        progressall : function(e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .bar').css('width', progress + '%');
        },
        drop: function (e, data) {
            $.each(data.files, function (index, file) {
                
            });
        },
        change: function (e, data) {
            $.each(data.files, function (index, file) {
                
            });
        }
    });
});