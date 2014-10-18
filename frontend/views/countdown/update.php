<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var frontend\models\Countdown $model
 */

$this->title = Yii::t('countdown', 'Update {modelClass}: ', [
  'modelClass' => 'Countdown',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('countdown', 'Countdowns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('countdown', 'Update');
?>
<div class="countdown-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
