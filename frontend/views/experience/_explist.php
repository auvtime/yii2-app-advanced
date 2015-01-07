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
		                        <!-- 显示经历图片，如果经历中有图片，则把第一张显示在左侧，如果没有经历图片，则显示用户头像 -->
								<div class="user-face col-lg-3">				
									<div class="face">
								   <?php 
								       $firstExpPic = $exp->firstExpPic;
								       if(!empty($firstExpPic)){
								   ?>
								           <img alt="哎呦喂，精彩生活！" src="<?php echo $firstExpPic->url;?>" class="face-pic">
								   <?php    
								       }else{
								           if(!empty($currentUser->face)){
								   ?>
								           <img alt="哎呦喂，精彩生活！" src="<?php echo $currentUser->face;?>" class="face-pic"> 
								   <?php
								           }else{
                                   ?>
                                           <img alt="哎呦喂，精彩生活！" src="/images/face/face.jpg" class="face-pic">
                                   <?php
								           }
								       }
								   ?>
									</div>			
								</div>
								<div class="exp-detail col-lg-9">				
		<?php
		echo '							<div class="content">'.$exp->content.'</div>			';
		foreach ($exp->expPicList as $expPic){
		  echo 'pic url:'.$expPic->url;   
		}
		echo '							<div class="create-time">'.Yii::t('experience', 'Created at ').':'.$exp->getCreatTimeDisplay().'</div>			';
		echo '							<div class="exp-time">'.Yii::t('experience', 'Experienced at ').':'.$exp->getExpTimeDisplay().'</div>			';
		echo '						</div>				';
		echo '					</div>					';
		
	}
}
?>
<div class="load-more row" id="loadMore" style="display: block;">
	<a id="nextPage" href="loadmore?page=1"></a> 
</div>