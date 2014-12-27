<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\bootstrap\Modal;

/**
 * @var yii\web\View $this
 * @var frontend\models\Experience $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<style>
.uploadImage,.create-exp-button{
    width:40%;
}
.uploadImage{
    float:left;
    margin:-10px 0 5px 30px;
}
#create-exprience{
    float:right;
    margin:-10px 30px 5px 0;
}
.uploadImgDisplay{
    margin:0 0 5px 0;
}
</style>
<div class="experience-form row">

    <?php $form = ActiveForm::begin([
		'id'=>'create-experience-form',
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
            <div class="row">
                <div class="uploadImage">
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span><?php echo Yii::t('experience', 'Add Images')?></span>
                        <input id="uploadExpImg" type="file" name="files[]" data-url="upload-exp-img" multiple/>
                    </span>
                </div>
                <div class="form-group pull-right create-exp-button">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('experience', 'Create') : Yii::t('experience', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'create-exprience']) ?>
                </div>
            </div>
            <div class="row uploadImgDisplay" id="uploadImgDisplay">
                
            </div>
		</div>
	</div>
    <?php ActiveForm::end(); ?>
	<?php
	    Modal::begin([
	            'id' => 'restmodal',
	            'header' => '<h4>'.Yii::t('experience', 'Tips').'</h4>',
	            'closeButton' => ['label' => '<h4>X</h4>'],
	        ]);
	    
	    echo "<div id='modalContent'><h4>".Yii::t('experience', 'Have a rest now and get a cup of tea!')."</h4></div>";
	 
	    Modal::end();
	    
	    Modal::begin([
		    'id' => 'contentmodal',
		    'header' => '<h4>'.Yii::t('experience', 'Tips').'</h4>',
		    'closeButton' => ['label' => '<h4>X</h4>'],
	    ]);
	     
	    echo "<div id='modalContent'><h4>".Yii::t('experience', 'Your already have a same experience!')."</h4></div>";
	    
	    Modal::end();
    ?>
</div>