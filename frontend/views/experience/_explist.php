<?php
if(empty($explist)){
	echo '<div id="noDataFound" class="alert alert-info">'.Yii::t('experience', 'You haven\'t any experience yet now.').'</div>';
}else{
	foreach ($explist as $exp){
		echo '	<div class="experience row">									';
		echo '						<div class="user-face col-lg-2">				';
		echo '							<div class="face"></div>			';
		echo '						</div>				';
		echo '						<div class="exp-detail col-lg-10">				';
		echo '							<div class="content">'.$exp->content.'</div>			';
		echo '							<div class="create-time">'.$exp->create_time.'</div>			';
		echo '							<div class="exp-time">'.$exp->exp_time.'</div>			';
		echo '						</div>				';
		echo '					</div>					';
		
	}
}