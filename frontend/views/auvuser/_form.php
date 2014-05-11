<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\AUVUser $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="auvuser-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'birthday')->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'create_time')->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'update_time')->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'leave_age')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'role')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'public_flag')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'time_unit')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 120]) ?>

    <?= $form->field($model, 'face')->textInput(['maxlength' => 1000]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
