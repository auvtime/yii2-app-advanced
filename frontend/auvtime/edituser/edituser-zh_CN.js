$(document).ready(function(){
	$('#getLunarBirthday').click(function(){
		var solarBirthday = $('#user-birthday').val();
		$.post('/my/get-lunar-birthday', {
			'solar-birthday':solarBirthday
		},function(data){
			var flag = data.flag;
			if(flag == 'success'){
				var lunarBirthday = data.lunarBirthday;
				$('#user-lunar_birthday').val(lunarBirthday);
			}
		},'json');
	});
});