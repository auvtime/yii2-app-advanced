<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;

/**
 * @var yii\web\View $this
 * @var app\models\Experience $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="experience-form row">

    <?php $form = ActiveForm::begin([
		'id'=>'craete-experience-form',
    	'action'=>'/experience/create',
    	'beforeSubmit' => 'submitForm'
    ]); ?>
    <div class="col-lg-8">
		<div class="row">
			<div class="col-lg-6">
	    		<?= $form->field($model, 'exp_time')->textInput(['maxlength' => 6])->label(Yii::t('experience', 'When?')) ?>
	    	</div>
			<div class="col-lg-6">
	    		<?= $form->field($model, 'time_unit')->dropDownList(User::getTimeUnitOptions())->label(Yii::t('experience', 'Time Unit?')) ?>
	    	</div>
		</div>
	    <div class="row">
	    	<div class="col-lg-12"><?= $form->field($model, 'content')->textArea(['rows' => 5])->label(Yii::t('experience', 'What happended to you?')) ?></div>
		</div>
		<div class="row">
		    <div class="form-group pull-right create-exp-button">
		        <?= Html::submitButton($model->isNewRecord ? Yii::t('experience', 'Create') : Yii::t('experience', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'create-exprience']) ?>
		    </div>
		</div>
	</div>
    <?php ActiveForm::end(); ?>

</div>