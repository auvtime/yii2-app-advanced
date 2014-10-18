<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var frontend\models\Countdown $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('countdown', 'Countdowns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="countdown-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('countdown', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('countdown', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('countdown', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'event_title',
            'event_desc',
            'event_time',
            'create_time',
            'update_time',
        ],
    ]) ?>

</div>
