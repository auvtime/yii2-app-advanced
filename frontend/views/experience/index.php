<?php

use yii\helpers\Html;
use yii\grid\GridView;
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
		<div class="col-lg-8">
		    
		</div>
	</div>
</div>
