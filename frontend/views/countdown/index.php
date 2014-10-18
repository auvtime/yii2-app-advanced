<?php

use frontend\assets\CountdownAsset;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var frontend\models\CountdownSearch $searchModel
 */
$this->title = Yii::t('countdown', 'My Countdown');
CountdownAsset::register($this);
?>
<div class="countdown-index">
	<div class="row add-countdown">
		<div class="col-lg-8">
			<button class="btn btn-primary" id="addCountdown"><?php echo Yii::t ( 'countdown', 'Add Countdown' )?></button>
		</div>
	</div>
	<div class="row">
		<div id="countdown-list"></div>
	</div>
</div>
