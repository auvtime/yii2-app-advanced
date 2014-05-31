<?php

use yii\helpers\Html;
use frontend\assets\ExprienceAsset;

/**
 * @var yii\web\View $this
 * @var app\models\Experience $model
 */

$this->title = Yii::t('experience', 'Update {modelClass}', [
  'modelClass' => Yii::t('experience', 'Experience'),
]);
$this->params['breadcrumbs'][] = Yii::t('experience', 'Update');
ExprienceAsset::register($this);
?>
<div class="experience-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
