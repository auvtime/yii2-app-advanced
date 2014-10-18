<?php foreach ($countdownList as $countdown){?>
<div class="countdown">
	<div class="countdown-title"><?php echo $countdown->event_title."  ".$countdown->event_time;?></div>
	<div class="countdown-time">
		<input type="hidden" name="event_time"
			value="<?php echo $countdown->event_time;?>">
		<div class="countdown-detail"></div>
	</div>
</div>
<?php }?>
<script type="text/javascript">
$(document).ready(function(){
    $("input[name=event_time]").each(function(){
        var eventTimeStr = $(this).val();
        if(!(eventTimeStr == "" || eventTimeStr == "undefined")){
        	var eventTime = getDate(eventTimeStr);
        	if(eventTime!="undefined"){
        		$(this).parent().find('.countdown-detail').countdown({
        			timestamp	: eventTime.getTime(),
        			callback	: function(days, hours, minutes, seconds){
        				
        			}
        		});
        	}
        }
    	
    });
	
});
</script>