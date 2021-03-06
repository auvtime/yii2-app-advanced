<?php

use yii\helpers\Html;
use frontend\models\Achievement;
use frontend\assets\AchievementAsset;
use yii\jui\DialogAsset;
use yii\jui\ThemeAsset;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var frontend\models\AchievementSearch $searchModel
 */

$this->title = Yii::t('auvtime', 'My Achievements');
$this->params['breadcrumbs'][] = $this->title;
$model = new Achievement();
AchievementAsset::register($this);
ThemeAsset::register($this);
DialogAsset::register($this);
?>
<div id="statusMsg"></div>
<div class="achievement-index">
	<h1><?= Html::encode($this->title) ?></h1>
	<div class="row">
    	<div class="achievement-create">
			<?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
    	</div>
    </div>
    <div class="separator"></div>
    <input type="hidden" id="faceUrl" value="<?php echo $currentUser->face;?>">
    <div class="row">
		<div class="col-lg-12">
		    <div class="achievement-list col-lg-8">
				<div id="ach-template" class="achievement row" style="display:none">
					<div class="ach-menu"  style="position: absolute; z-index: 999;">
						<div class="dropdown">
	            	    	<a role="button" data-toggle="dropdown" data-target="#" exp-data="" class="ach-menu-icon-choose ach-menu-button"></a>
		                	<ul class="dropdown-menu" role="menu">
			                	<li role="presentation"><a role="menuitem" tabindex="-1" menu-type="delete-ach" href="javascript:;" title="<?php echo Yii::t('achievement', 'Delete this achievement')?>"><?php echo Yii::t('achievement', 'Delete this achievement')?></a></li>
		                    </ul>
			               	
	            	    </div>
            	    </div>
					<div class="user-face col-lg-2">
						<div class="face"></div>
					</div>
					<div class="ach-detail col-lg-10">
						<div class="content"></div>
						<div class="create-time"></div>
						<div class="ach-time"></div>
					</div>
				</div>
				<?= $this->render('_achlist',[
					'achlist' => $achlist,
				])?>
		    </div>
		</div>
	</div>
</div>

<div id="dDialog" title="<?php echo Yii::t('achievement', 'Please confirm')?>" style="display: none">
	<span id="dTip"><?php echo Yii::t('achievement', 'Are you sure to delete this achievement?')?></span>
</div>