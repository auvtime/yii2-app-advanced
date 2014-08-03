<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var frontend\models\MyCare $model
 */

$this->title = Yii::t('my-care', 'Update {modelClass}: ', [
  'modelClass' => 'My Care',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('my-care', 'My Cares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('my-care', 'Update');
?>
<div class="my-care-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
