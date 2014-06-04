<?php
if(empty($explist)){
	echo '<div id="noDataFound" class="alert alert-info">'.Yii::t('experience', 'You haven\'t any experience yet now.').'</div>';
}else{
	foreach ($explist as $exp){
		?>
							<div class="experience row">
								<div class="exp-menu"  style="position: absolute; z-index: 999;">
									<div class="dropdown">
				            	    	<a role="button" data-toggle="dropdown" data-target="#" exp-data="<?php echo $exp->id?>" class="exp-menu-icon-choose exp-menu-button"></a>
					                	<ul class="dropdown-menu" role="menu">
						                	<li role="presentation"><a role="menuitem" tabindex="-1" menu-type="delete-exp" href="javascript:;" title="<?php echo Yii::t('experience', 'Delete this experience')?>"><?php echo Yii::t('experience', 'Delete this experience')?></a></li>
						                    <li role="presentation"><a role="menuitem" tabindex="-1" menu-type="add-to-ach" href="javascript:;" title="<?php echo Yii::t('experience', 'Add to achievement')?>"><?php echo Yii::t('experience', 'Add to achievement')?></a></li>
					                    </ul>
				            	    </div>
			            	    </div>
		 
								<div class="user-face col-lg-2">				
									<div class="face"></div>			
								</div>				';
								<div class="exp-detail col-lg-10">				
		<?php
		echo '							<div class="content">'.$exp->content.'</div>			';
		echo '							<div class="create-time">'.Yii::t('experience', 'Created at ').':'.$exp->getCreatTimeDisplay().'</div>			';
		echo '							<div class="exp-time">'.Yii::t('experience', 'Experienced at ').':'.$exp->getExpTimeDisplay().'</div>			';
		echo '						</div>				';
		echo '					</div>					';
		
	}
}