<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\AUVUser $model
 */

$this->title = 'Create Auvuser';
$this->params['breadcrumbs'][] = ['label' => 'Auvusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auvuser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
