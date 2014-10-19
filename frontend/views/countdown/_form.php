<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\assets\My97DatePickerAsset;
use frontend\assets\CountdownAsset;

/**
 * @var yii\web\View $this
 * @var frontend\models\Countdown $model
 * @var yii\widgets\ActiveForm $form
 */
My97DatePickerAsset::register($this);
CountdownAsset::register($this);
?>
<script type="text/javascript">
function submitForm($form) {
	$('#statusMsg').hide();
	var createUrl = $form.attr("action");
	var createData = $form.serialize();
	$.post(createUrl, createData).success(function(result) {
		if(result == 'success'){
			window.parent.loadCountList();
			close();
		}else{
			$('#statusMsg').html(result).addClass('alert alert-danger').show();
		}
		return false;
	});
	return false;
}
//关闭窗口
function close(){
	var isNew = <?php echo $model->isNewRecord?"true":"false"?>;
	if(isNew){
		window.parent.closeCreatePage();
	}else{
		var careId = <?php echo $model->isNewRecord?"-1":$model->id?>;
		var msgboxId = 'edit' + careId;
		window.parent.closeUpdatePage(msgboxId);
	}
}
</script>
<div id="statusMsg"></div>
<div class="countdown-form">

    <?php $form = ActiveForm::begin([
		'id'=>'create-countdown-form',
    	'action'=>($model->isNewRecord?'/countdown/create':'/countdown/update'),
    	'beforeSubmit' => 'submitForm'
    ]); ?>
    <div class="row">
		<div class="col-xs-6">
		    <input type="hidden" value="<?= $model->id?>" name="countdown-id" id="countdown-id">
            <?= $form->field($model, 'event_title')->textInput(['maxlength' => 100]) ?>
        </div>
        <div class="col-xs-6">
    		<?= $form->field($model, 'event_time')->textInput()?>
		</div>
    </div>
    <div class="row">
		<div class="col-xs-12">
		    <?=$form->field($model, 'event_desc')->textArea()?>
	    </div>
	</div>
    <div class="row">
        <div class="form-group col-xs-6">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('countdown', 'Create') : Yii::t('countdown', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <a href="javascript:close();" id="close" class="btn btn-primary"><?php echo Yii::t('countdown', 'Close')?></a>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
