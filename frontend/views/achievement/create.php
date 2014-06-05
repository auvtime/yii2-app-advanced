<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var frontend\models\Achievement $model
 */

$this->title = Yii::t('achievement', 'Create {modelClass}', [
  'modelClass' => 'Achievement',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('achievement', 'Achievements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="achievement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
