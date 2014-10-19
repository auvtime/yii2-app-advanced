function loadCountList(){
	$.ajax({
		url:'/countdown/countdown-list',
		success:function(data){
			$('#countdown-list').html(data);
		}
	});
}
//字符串转日期格式，strDate要转为日期格式的字符串
function getDate(strDate) {
    var st = strDate;
    var a = st.split(" ");
    var b = a[0].split("-");
    var c = a[1].split(":");
    var date = new Date(b[0], b[1] - 1, b[2], c[0], c[1], c[2]);
    return date;
}
//关闭添加窗口
function closeCreatePage(){
	$('#addCountdown').msgbox().close();
}
$(document).ready(function(){
	loadCountList();
	$.msgbox.defaults({
		overlayEvent: 'close',
		resize: false,
		lang: 'zh_CN',
		opacity:.5,
		zIndex:99999999
	});
	$('#addCountdown').msgbox({
		type:'iframe',
		content: '/countdown/create',
		height:400
	});
	//事件发生事件日期控件
	$("#countdown-event_time").click(function(){
		WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});
	});
});