<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var frontend\models\MyCare $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('my-care', 'My Cares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my-care-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('my-care', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('my-care', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('my-care', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'nick_name',
            'solar_birthday',
            'lunar_birthday',
            'remark',
            'create_time',
            'update_time',
        ],
    ]) ?>

</div>
