<?php

use yii\helpers\Html;
use app\models\Experience;
use frontend\assets\ExprienceAsset;
use yii\jui\DialogAsset;
use yii\jui\ThemeAsset;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\ExperienceSearch $searchModel
 */

$this->title = Yii::t('experience', 'My Experiences');
$this->params['breadcrumbs'][] = $this->title;
ExprienceAsset::register($this);
$model = new Experience();
ThemeAsset::register($this);
DialogAsset::register($this);
?>
<div class="experience-index">

    <h1><?= Html::encode($this->title) ?></h1>
	
    <div class="row">
    	<div class="create-experience">
			<?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
    	</div>
    </div>
	<div class="separator"></div>
	<div class="row">
		<div class="col-lg-12">
		    <div class="experience-list col-lg-8">
				<div id="exp-template" class="experience row" style="display:none ">
					<div class="exp-menu"  style="position: absolute; z-index: 999;">
						<div class="dropdown">
	            	    	<a role="button" data-toggle="dropdown" data-target="#" exp-data="" class="exp-menu-icon-choose exp-menu-button"></a>
		                	<ul class="dropdown-menu" role="menu">
			                	<li role="presentation"><a role="menuitem" tabindex="-1" menu-type="delete-exp" href="javascript:;" title="<?php echo Yii::t('experience', 'Delete this experience')?>"><?php echo Yii::t('experience', 'Delete this experience')?></a></li>
			                    <li role="presentation"><a role="menuitem" tabindex="-1" menu-type="add-to-ach" href="javascript:;" title="<?php echo Yii::t('experience', 'Add to achievement')?>"><?php echo Yii::t('experience', 'Add to achievement')?></a></li>
		                    </ul>
			               	
	            	    </div>
            	    </div>
					<div class="user-face col-lg-2">
						<div class="face"></div>
					</div>
					<div class="exp-detail col-lg-10">
						<div class="content"></div>
						<div class="create-time"></div>
						<div class="exp-time"></div>
					</div>
				</div>
				<?= $this->render('_explist',[
					'explist' => $explist,
				])?>
		    </div>
		</div>
	</div>
</div>


<div id="dDialog" title="<?php echo Yii::t('experience', 'Please confirm')?>" style="display: none">
	<?php echo Yii::t('experience', 'Are you sure to delete this experience?')?>
</div>

