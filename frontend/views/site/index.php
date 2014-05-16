<?php
use frontend\assets\ClockAsset;
/**
 * @var yii\web\View $this
 */
$this->title = "AUVTime-It's all about time!";
ClockAsset::register($this);
?>
<div class="row">
	<div class="col-lg-6">
		<div class="jumbotron">
			<h1>AUVTime</h1>
			<p><?php echo \Yii::t('auvtime', 'It\'s all about time!')?></p>
		</div>
			<div class="time-maxim">
	           <span><?php echo \Yii::t('auvtime', 'The time never stops it\'s step,so let\'s value our time!')?></span>
	        </div>
	</div>
	<div  class="col-lg-6">
		<div class="clock">
			<ul id="clock">
				<li id="sec"></li>
				<li id="hour"></li>
				<li id="min"></li>
			</ul>
		</div>
	</div>
</div>