<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var frontend\models\Experience $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('experience', 'Experiences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="experience-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('experience', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('experience', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('experience', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'content',
            'time_unit',
            'exp_time',
            'user_id',
            'create_time',
            'update_time',
        ],
    ]) ?>

</div>
