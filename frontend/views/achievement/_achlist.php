<?php
if(empty($achlist)){
	echo '<div id="noDataFound" class="alert alert-info">'.Yii::t('achievement', 'You haven\'t any achievement yet now.').'</div>';
}else{
	foreach ($achlist as $ach){
		?>
							<div class="achievement row">
								<div class="ach-menu"  style="position: absolute; z-index: 999;">
									<div class="dropdown">
				            	    	<a role="button" data-toggle="dropdown" data-target="#" ach-data="<?php echo $ach->id?>" class="ach-menu-icon-choose ach-menu-button"></a>
					                	<ul class="dropdown-menu" role="menu">
						                	<li role="presentation"><a role="menuitem" tabindex="-1" menu-type="delete-ach" href="javascript:;" title="<?php echo Yii::t('achievement', 'Delete this achievement')?>"><?php echo Yii::t('achievement', 'Delete this achievement')?></a></li>
					                    </ul>
				            	    </div>
			            	    </div>
		 
								<div class="user-face col-lg-3">				
									<div class="face"></div>			
								</div>
								<div class="ach-detail col-lg-9">				
		<?php
		echo '							<div class="content">'.$ach->content.'</div>			';
		echo '							<div class="create-time">'.Yii::t('achievement', 'Created at').':'.$ach->getCreatTimeDisplay().'</div>			';
		echo '							<div class="ach-time">'.Yii::t('achievement', 'Achieved at').':'.$ach->getAchieveTimeDisplay().'</div>			';
		echo '						</div>				';
		echo '					</div>					';
		
	}
}