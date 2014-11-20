$(document).ready(function() {
	$("#auvtime-nav").headroom({
		"tolerance" : 5,
		"offset" : 100,
		"classes" : {
			"initial" : "animated",
			"pinned" : "swingInX",
			"unpinned" : "swingOutX",
			"top" : "headroom--top",
			"notTop" : "headroom--not-top"
		}
	});
	var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
	document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fdfb059dd6dbf96abae9e238dce5aa190' type='text/javascript'%3E%3C/script%3E"));
});