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
	<ul class="liuyan row">
	<?php foreach ($myCareList as $care){?>
		<li class="ly_list">
			<div class="ly_titleBg"></div>
			<div class="ly_titleTxt"><?php echo $care->relationship.$care->name?>：</div>
			<div class="ly_content">
				<p><?php echo $care->getMyCaredPersonsAge()?></p>
			</div>
		</li>
	<?php }?>
	</ul>
</div>
