<ul class="liuyan">
<?php foreach ($myCareList as $care){?>
	<li class="ly_list">
		<div class="ly_titleBg"></div>
		<div class="ly_titleTxt"><?php echo $care->relationship.$care->name?>：</div>
		<div style="position: absolute; z-index: 999;" class="context-menu">
			<div class="dropdown">
    	    	<a class="context-menu-icon-choose context-menu-button" context_data="274" data-target="#" data-toggle="dropdown" role="button"></a>
            	<ul role="menu" class="dropdown-menu" style="visibility: hidden;">
                	<li role="presentation"><a title="删除" href="javascript:;" menu-type="delete-exp" tabindex="-1" role="menuitem">删除</a></li>
                    <li role="presentation"><a title="编辑" href="javascript:;" menu-type="add-to-ach" tabindex="-1" role="menuitem">编辑</a></li>
                </ul>
    	    </div>
	    </div>
		<div class="ly_content">
			<p><?php echo $care->getMyCaredPersonsAge()?></p>
		</div>
	</li>
<?php }?>
</ul>