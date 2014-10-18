<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var frontend\models\Countdown $model
 */

$this->title = Yii::t('countdown', 'Create {modelClass}', [
  'modelClass' => 'Countdown',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('countdown', 'Countdowns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="countdown-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
