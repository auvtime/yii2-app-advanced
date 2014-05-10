<?php
use frontend\assets\ClockAsset;
/**
 * @var yii\web\View $this
 */
$this->title = "AUVTime-It's all about time!";
ClockAsset::register($this);
?>
<div class="site-index">
	<div class="jumbotron">
		<h1>AUVTime</h1>
		<p class="lead">It's all about time!</p>
	</div>
	<div class="body-content">
		<div class="time-maxim">
           <span>The time never stops it's step,so let's value our time!</span>
        </div>
	</div>
</div>
<div class="clock">
	<ul id="clock">
		<li id="sec"></li>
		<li id="hour"></li>
		<li id="min"></li>
	</ul>
</div>