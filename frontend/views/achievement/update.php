<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var frontend\models\Achievement $model
 */

$this->title = Yii::t('achievement', 'Update {modelClass}: ', [
  'modelClass' => 'Achievement',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('achievement', 'Achievements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('achievement', 'Update');
?>
<div class="achievement-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
