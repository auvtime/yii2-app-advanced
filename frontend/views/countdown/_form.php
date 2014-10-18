<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var frontend\models\Countdown $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="countdown-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'event_title')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'event_time')->textInput() ?>

    <?= $form->field($model, 'create_time')->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'update_time')->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'event_desc')->textInput(['maxlength' => 2000]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('countdown', 'Create') : Yii::t('countdown', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
