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
$(document).ready(function(){
	loadCountList();
});