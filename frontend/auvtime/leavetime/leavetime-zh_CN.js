$(document).ready(function(){
	var leaveTime = $('#leaveTimeFull').val();
	var year = '';
	var month = '';
	var day = '';
	var hour = '';
	var minute = '';
	var second = '';
	var days = '';
	year = parseInt(leaveTime.substring(0, leaveTime.indexOf('年', 0) + 1));
	month = addZero(parseInt(leaveTime.substring(leaveTime.indexOf('年', 0)+1, leaveTime.indexOf('个月', 0))));
	day = addZero(parseInt(leaveTime.substring(leaveTime.indexOf('个月', 0)+2, leaveTime.indexOf('天', 0))));
	hour = addZero(parseInt(leaveTime.substring(leaveTime.indexOf('天', 0)+1, leaveTime.indexOf('小时', 0))));
	minute = addZero(parseInt(leaveTime.substring(leaveTime.indexOf('小时', 0)+2, leaveTime.indexOf('分钟', 0))));
	second = addZero(parseInt(leaveTime.substring(leaveTime.indexOf('分钟', 0)+2, leaveTime.indexOf('秒', 0))));
	days = parseInt(leaveTime.substring(leaveTime.indexOf(',', 0)+1, leaveTime.length - 2));
	var startTime = year + '年' + month + '个月' + day + '天' + hour + '小时' + minute + '分钟' + second + '秒';
	var options = {
		image : "/images/countdown/digits.png",
	    format:'yy年MM个月dd天hh小时mi分钟ss秒',
	    startTime:startTime,
	    digitImages:6
	};
	$('#countdown').countdown(options);
	
});
/**
 * 参数：数字 用在时间等函数中，当传递的参数小于10的时候，给该参数前边添加0并返回
 */
function addZero(num) {
	if (num < 10) {
		num = '0' + num;
	}
	return num;
}