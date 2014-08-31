<style>
.context-menu {
	margin: 2% 0 0 85%;
	position: absolute;
	width: 50px;
}

.context-menu .menu {
	width: 50%;
	background-image: url("/images/icon.png");
	background-repeat: no-repeat;
	float: left;
	margin: 5px 5px 0 0;
	visibility: hidden;
}

.context-menu .del-menu {
	background-position: -75px -25px;
	height: 16px;
	width: 16px;
}

.context-menu .edit-menu {
	background-position: -75px -150px;
	height: 16px;
	width: 16px;
}

.context-menu .del-menu:hover {
	background-position: -100px -25px;
	height: 16px;
	width: 16px;
}

.context-menu .edit-menu:hover {
	background-position: -100px -150px;
	height: 16px;
	width: 16px;
}
</style>
<ul class="liuyan">
<?php foreach ($myCareList as $care){?>
	<li class="ly_list">
		<div class="ly_orderNumBg"></div>
		<div class="ly_orderNumTxt"><?php echo $care->order_num?></div>
		<div class="ly_titleBg"></div>
		<div class="ly_titleTxt"><?php echo $care->relationship.$care->name?>：</div>
		<div class="context-menu" care-data="<?php echo $care->id?>">
			<a class="menu edit-menu" care-data="<?php echo $care->id?>"></a> 
			<a class="menu del-menu" care-data="<?php echo $care->id?>"></a>
		</div>
		<div class="ly_content">
            <div class="birthday">
                <div class="solar-birthday">阳历生日:<?php echo $care->solar_birthday?></div>
                <div class="lunar-birthday">农历生日:<?php echo $care->lunar_birthday?></div>
            </div>
			<p>年龄：<?php echo $care->getMyCaredPersonsAge()?></p>
		</div>
	</li>
<?php }?>
</ul>