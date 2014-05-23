$(document).ready(function(){
	var timeUnit = $('#timeUnit').val();
	var leaveTime = $('#leaveTimeFull').val();
	var year = '';
	var month = '';
	var day = '';
	var hour = '';
	var minute = '';
	var second = '';
	var days = '';
	year = parseInt(leaveTime.substring(0, leaveTime.indexOf('年', 0) + 1));
	month = parseInt(leaveTime.substring(leaveTime.indexOf('年', 0)+1, leaveTime.indexOf('个月', 0)));
	day = addZero(parseInt(leaveTime.substring(leaveTime.indexOf('个月', 0)+2, leaveTime.indexOf('天', 0))));
	hour = addZero(parseInt(leaveTime.substring(leaveTime.indexOf('天', 0)+1, leaveTime.indexOf('小时', 0))));
	minute = addZero(parseInt(leaveTime.substring(leaveTime.indexOf('小时', 0)+2, leaveTime.indexOf('分钟', 0))));
	second = addZero(parseInt(leaveTime.substring(leaveTime.indexOf('分钟', 0)+2, leaveTime.indexOf('秒', 0))));
	days = parseInt(leaveTime.substring(leaveTime.indexOf(',', 0)+1, leaveTime.length - 2));
	var startTime = day + '天' + hour + '小时' + minute + '分钟' + second + '秒';
	//alert(startTime);
	//alert('year:' + year + ',month:' + month + ',day:' + day + ',hour:' + hour + ',minute:' + minute + ',second:' + second);
	$('#countdown').countdown({
        image : "/images/countdown/digits.png",
        format:'dd天hh小时mi分钟ss秒',
        startTime:startTime,
        digitImages:6
    });
	var display = '';
	var minuteFlag = false;
	var hourFlag = false;
	var dayFlag = false;
	var monthFlag = false;
	//剩下的时间越来越少了
	var leftSecond = 60;
	setInterval(function() {
		second = new Date().getSeconds();
		leftSecond = 60 - second;
		if(leftSecond == 60){
			minuteFlag = true;
			minute -= 1;
		}
		second = leftSecond;
		if(minute == 0&&minuteFlag){
			hourFlag = true;
			hour -= 1;
			minute = 59 - minute;
		}else{
			hourFlag = false;
		}
		if(hour == 0&&hourFlag){
			dayFlag = true;
			day -= 1;
			hour = 23 - hour;
		}else{
			dayFlag = false;
		}
		
		if(day == 0&&dayFlag){
			monthFlag = true;
			month -= 1;
			day = getDays() - 1 - day;
		}else{
			monthFlag = false;
		}
		
		if(month == 0&&monthFlag){
			year -= 1;
			month = 11 - month;
		}
		if(dayFlag){
			days -= 1;
		}
		display = getDisplay(timeUnit,year,month,day,hour,minute,second,days);

		$('#leaveTime').html(display);
	}, 1000);
});

/**
 * 根据生命单位获取时间
 * @param timeUnit
 */
function getDisplay(timeUnit, year, month, day, hour, minute, second, days) {
	var display = '';
	if ('SECOND' == timeUnit) {
		if (year != 0) {
			display = year + '年';
		}
		if (month != 0) {
			display += month + '个月';
		}
		if (day != 0) {
			display += day + '天';
		}
		display += hour + '小时';

		display += minute + '分钟';

		display += second + '秒';

		if (days != 0) {
			display += ',' + days + '天.';
		}
	} else if ('MINUTE' == timeUnit) {
		if (year != 0) {
			display = year + '年';
		}
		if (month != 0) {
			display += month + '个月';
		}
		if (day != 0) {
			display += day + '天';
		}

		display += hour + '小时';

		display += minute + '分钟';

		if (days != 0) {
			display += ',' + days + '天.';
		}
	} else if ('HOUR' == timeUnit) {
		if (year != 0) {
			display = year + '年';
		}
		if (month != 0) {
			display += month + '个月';
		}
		if (day != 0) {
			display += day + '天';
		}

		display += hour + '小时';

		if (days != 0) {
			display += ',' + days + '天.';
		}
	} else if ('DAY' == timeUnit) {
		if (year != 0) {
			display = year + '年';
		}
		if (month != 0) {
			display += month + '个月';
		}
		if (day != 0) {
			display += day + '天';
		}
		if (days != 0) {
			display += ',' + days + '天.';
		}
	} else if ('MONTH' == timeUnit) {
		if (year != 0) {
			display = year + '年';
		}
		if (month != 0) {
			display += month + '个月';
		}
		if (days != 0) {
			display += ',' + days + '天.';
		}
	} else if ('YEAR' == timeUnit) {
		if (year != 0) {
			display = year + '年';
		}
		if (month != 0) {
			display += month + '个月';
		}
		if (days != 0) {
			display += ',' + days + '天.';
		}
	}
	return display;
}

/**
 * 获取当前时间月份有多少天
 * @returns
 */
function getDays() {
	var date = new Date();
	var y = date.getFullYear();
	var m = date.getMonth() + 1;
	if (m == 2) {
		return y % 4 == 0 ? 29 : 28;
	} else if (m == 1 || m == 3 || m == 5 || m == 7 || m == 8 || m == 10
			|| m == 12) {
		return 31;
	} else {
		return 30;
	}
}
/**
 * 参数：数字 用在时间等函数中，当传递的参数小于10的时候，给该参数前边添加0并返回
 */
function addZero(num) {
	if (num < 10) {
		num = '0' + num;
	}
	return num;
}