<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var frontend\models\MyCare $model
 */

$this->title = Yii::t('my-care', 'Create {modelClass}', [
  'modelClass' => 'My Care',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('my-care', 'My Cares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my-care-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
