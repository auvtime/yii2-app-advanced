<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\AUVUser $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Auvusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auvuser-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'nickname',
            'birthday',
            'public_flag',
            'leave_age',
            'time_unit',
            'mobile',
            'face',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'role',
            'status',
            'created_at',
            'updated_at',
            'create_time',
            'update_time',
        ],
    ]) ?>

</div>
