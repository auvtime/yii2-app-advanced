<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 *
 * @var yii\web\View $this
 * @var common\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-form">
	<div class="row">
		<div class="col-lg-8">
	    	<?php $form = ActiveForm::begin(); ?>
	    	<div class="row">
				<div class="col-lg-4">
			    	<?= $form->field($model, 'username')->textInput(['maxlength' => 255])?>
				</div>
				<div class="col-lg-4">
		    		<?= $form->field($model, 'email')->textInput(['maxlength' => 255])?>
		    	</div>
				<div class="col-lg-4">
		    		<?= $form->field($model, 'mobile')->textInput(['maxlength' => 120])?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
		    		<?= $form->field($model, 'leave_age')->textInput(['maxlength' => 20])?>
				</div>
				<div class="col-lg-4">
		    		<?= $form->field($model, 'nickname')->textInput(['maxlength' => 255])?>
				</div>
				<div class="col-lg-4">
		    		<?= $form->field($model, 'time_unit')->dropDownList($model->getTimeUnitOptions())?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
		    		<?= $form->field($model, 'face')->textInput(['maxlength' => 1000])?>
		    	</div>
				<div class="col-lg-4">
		    		<?= $form->field($model, 'public_flag')->dropDownList($model->getPublicFlagOptions())?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-8">
					<?= Html::submitButton(Yii::t('auvtime-myprofile', 'Update'), ['class' => 'btn btn-primary'])?>
				</div>
			</div>
	    	<?php ActiveForm::end(); ?>
	    </div>
	</div>
</div>