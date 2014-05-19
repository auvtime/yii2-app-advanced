$(document).ready(function(){
	var timeUnit = $('#timeUnit').val();
	var lifeTime = $('#lifeTimeFull').val();
	var year = '';
	var month = '';
	var day = '';
	var hour = '';
	var minute = '';
	var second = '';
	var days = '';
	year = parseInt(lifeTime.substring(0, lifeTime.indexOf('year', 0)));
	month = parseInt(lifeTime.substring(lifeTime.indexOf('year', 0) +5 , lifeTime.indexOf('month', 0)));
	day = parseInt(lifeTime.substring(lifeTime.indexOf('month', 0)+6, lifeTime.indexOf('day', 0)));
	hour = parseInt(lifeTime.substring(lifeTime.indexOf('day', 0)+4, lifeTime.indexOf('hour', 0)));
	minute = parseInt(lifeTime.substring(lifeTime.indexOf('hour', 0)+5, lifeTime.indexOf('minute', 0)));
	second = parseInt(lifeTime.substring(lifeTime.indexOf('minute', 0)+7, lifeTime.indexOf('second', 0)));
	
	if(lifeTime.indexOf(',', 0)>0){
		days = parseInt(lifeTime.substring(lifeTime.indexOf(',', 0)+1, lifeTime.length - 5));
	}
	
	var display = '';
	var minuteFlag = false;
	var hourFlag = false;
	var dayFlag = false;
	var monthFlag = false;
	//设置当前时间
	setInterval(function() {
		second = new Date().getSeconds();
		if((second+1)>=60){
			minuteFlag = true;
			minute += 1;
			second = 0;
		}else{
			minuteFlag = false;
			second += 1;
		}
		if(minute>=60&&minuteFlag){
			hourFlag = true;
			hour += 1;
			minute = 0;
		}else{
			hourFlag = false;
		}
		if(hour>=24&&hourFlag){
			dayFlag = true;
			day += 1;
			hour = 0;
		}else{
			dayFlag = false;
		}
		
		if(day>=getDays()&&dayFlag){
			monthFlag = true;
			month += 1;
			day = 0;
		}else{
			monthFlag = false;
		}
		
		if(month>=12&&monthFlag){
			year += 1;
			month = 0;
		}
		if(dayFlag){
			days += 1;
		}
		display = getDisplay(timeUnit,year,month,day,hour,minute,second,days);
		$('#lifeTime').html(display);
	}, 1000);
});
function doPlural(value,str){
	return value>1?" " + str+"s ":" " + str + " ";
}
/**
 * 根据生命单位获取时间
 * @param timeUnit
 */
function getDisplay(timeUnit, year, month, day, hour, minute, second, days) {
	var display = '';
	if ('SECOND' == timeUnit) {
		if (year != 0) {
			display = year + doPlural(year,'year');
		}
		if (month != 0) {
			display += month + doPlural(month,'month');
		}
		if (day != 0) {
			display += day + doPlural(day,'day');
		}
		display += hour + doPlural(hour,'hour');

		display += minute + doPlural(minute,'minute');

		display += second + doPlural(second,'second');

		if (days != 0) {
			display += ',' + days + ' days.';
		}
	} else if ('MINUTE' == timeUnit) {
		if (year != 0) {
			display = year + doPlural(year,'year');
		}
		if (month != 0) {
			display += month + doPlural(month,'month');
		}
		if (day != 0) {
			display += day + doPlural(day,'day');
		}
		display += hour + doPlural(hour,'hour');

		display += minute + doPlural(minute,'minute');

		if (days != 0) {
			display += ',' + days + ' days.';
		}
	} else if ('HOUR' == timeUnit) {
		if (year != 0) {
			display = year + doPlural(year,'year');
		}
		if (month != 0) {
			display += month + doPlural(month,'month');
		}
		if (day != 0) {
			display += day + doPlural(day,'day');
		}
		display += hour + doPlural(hour,'hour');

		if (days != 0) {
			display += ',' + days + ' days.';
		}
	} else if ('DAY' == timeUnit) {
		if (year != 0) {
			display = year + doPlural(year,'year');
		}
		if (month != 0) {
			display += month + doPlural(month,'month');
		}
		if (day != 0) {
			display += day + doPlural(day,'day');
		}
		if (days != 0) {
			display += ',' + days + ' days.';
		}
	} else if ('MONTH' == timeUnit) {
		if (year != 0) {
			display = year + doPlural(year,'year');
		}
		if (month != 0) {
			display += month + doPlural(month,'month');
		}
		if (days != 0) {
			display += ',' + days + ' days.';
		}
	} else if ('YEAR' == timeUnit) {
		if (year != 0) {
			display = year + doPlural(year,'year');
		}
		if (days != 0) {
			display += ',' + days + ' days.';
		}
	}
	return display;
}

/**
 * 获取当前时间月份有多少 days
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
/**
 * 参数：给定的开始时间
 * 计算出该时间和当前时间相隔的年数，月数和 days数
 */
function timeElapseYearMonthDay(date){
	var currentDate = Date();
	var currentYear = currentDate.getYear();
	var oldYear = date.getYear();
	var yearInterval = currentYear - oldYear;
	
}
/**
 * 参数：给定的时间 
 * 给定一个时间，计算此时间距离当前时间的 days数， hours数， minutes数， seconds数并返回字符串 
 * 字符串格式为：xx daysxx hoursxx minutesxx seconds
 */
function timeElapse(date) {
	var current = Date();
	var seconds = (Date.parse(current) - Date.parse(date)) / 1000;
	var days = Math.floor(seconds / (3600 * 24));
	seconds = seconds % (3600 * 24);
	var hours = Math.floor(seconds / 3600);
	hours = addZero(hours);
	seconds = seconds % 3600;
	var minutes = Math.floor(seconds / 60);
	minutes = addZero(minutes);
	seconds = seconds % 60;
	seconds = addZero(seconds);
	var result = "<span class=\"digit\">" + days
			+ " days</span><span class=\"digit\">" + hours
			+ " hours</span><span class=\"digit\">" + minutes
			+ " minutes</span><span class=\"digit\">" + seconds + " seconds</span>";
	return result;
}

/**
 * 参数：给定时间的字符串，格式为：1984-06-10 12:00:00
 * 返回给字符串的日期
 */
function getDateFromString(timeString) {
	var year = timeString.substr(0,4);
	var month = timeString.substr(5,2);
	var day = timeString.substr(8,2);
	var hours = timeString.substr(11,2);
	var minutes = timeString.substr(14,2);
	var seconds = timeString.substr(17,2);
	var date = new Date(year, month, day, hours, minutes, seconds);
	return date;
}