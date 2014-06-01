<?php

use yii\helpers\Html;
use app\models\Experience;
use frontend\assets\ExprienceAsset;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\ExperienceSearch $searchModel
 */

$this->title = Yii::t('experience', 'My Experiences');
$this->params['breadcrumbs'][] = $this->title;
ExprienceAsset::register($this);
$model = new Experience();
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
				<div id="exp-template" class="experience row" style="display: none">
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
