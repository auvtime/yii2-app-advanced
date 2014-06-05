<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var frontend\models\Achievement $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="achievement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'time_unit')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'exp_id')->textInput() ?>

    <?= $form->field($model, 'achieve_time')->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'create_time')->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'update_time')->textInput(['maxlength' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('achievement', 'Create') : Yii::t('achievement', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
