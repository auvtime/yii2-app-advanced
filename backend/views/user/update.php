<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 */

$this->title = Yii::t('auvtime-myprofile', 'Update {modelClass}: ', [
  'modelClass' => 'User',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('auvtime-myprofile', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('auvtime-myprofile', 'Update');
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
