<?php
use frontend\assets\MyCareAsset;

/**
 *
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var frontend\models\MyCareSearch $searchModel
 */

$this->title = Yii::t ( 'my-care', 'My Cares' );
$this->params ['breadcrumbs'] [] = $this->title;
MyCareAsset::register($this);
?>
<div class="my-care-index row">
	<div class="row add-my-care">
		<div class="col-lg-8">
			<button class="btn btn-primary" id="addMyCare">添加关心的人</button>
		</div>
	</div>
	<div class="row">
		<div id="my-care-list">
		  
		</div>
	</div>
</div>
