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
});