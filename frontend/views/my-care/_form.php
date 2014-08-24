<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var frontend\models\MyCare $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<script type="text/javascript">
function submitForm($form) {
	var createUrl = $form.attr("action");
	var createData = $form.serialize();
	$.post(createUrl, createData).success(function(result) {
		if(result == 'success'){
			window.parent.closePage();
		}
		return false;
	});
	return false;
}
//关闭窗口
function close(){
	window.parent.closePage();
}
</script>
<div class="my-care-form">

    <?php $form = ActiveForm::begin([
		'id'=>'create-my-care-form',
    	'action'=>'/my-care/create',
    	'beforeSubmit' => 'submitForm'
    ]); ?>
    <div class="row">
		<div class="col-xs-6">
			<?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>
    	</div>
    	<div class="col-xs-6">
    		<?= $form->field($model, 'relationship')?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6">
    		<?= $form->field($model, 'solar_birthday')?>
		</div>
		<div class="col-xs-6">
    		<?= $form->field($model, 'lunar_birthday') ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6">
    		<?= $form->field($model, 'nick_name')->textInput(['maxlength' => 100]) ?>
		</div>
		<div class="col-xs-6">
    		<?= $form->field($model, 'remark')->textInput(['maxlength' => 1000]) ?>
		</div>
	</div>
	<div class="row">
	    <div class="form-group col-xs-6">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('my-care', 'Create') : Yii::t('my-care', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	        <a href="javascript:close();" id="close" class="btn btn-primary"><?php echo Yii::t('my-care', 'Close')?></a>
	    </div>
	</div>
    <?php ActiveForm::end(); ?>

</div>
