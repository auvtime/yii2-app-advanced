<ul class="liuyan">
<?php foreach ($myCareList as $care){?>
	<li class="ly_list">
		<div class="ly_titleBg"></div>
		<div class="ly_titleTxt"><?php echo $care->relationship.$care->name?>：</div>
		<div class="ly_content">
			<p><?php echo $care->getMyCaredPersonsAge()?></p>
		</div>
	</li>
<?php }?>
</ul>