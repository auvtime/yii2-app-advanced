<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var frontend\models\MyCare $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="my-care-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>
    
    <?= $form->field($model, 'relationship')?>

    <?= $form->field($model, 'solar_birthday')?>

    <?= $form->field($model, 'lunar_birthday') ?>

    <?= $form->field($model, 'nick_name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => 1000]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('my-care', 'Create') : Yii::t('my-care', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
