<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\bootstrap\Modal;
/**
 * @var yii\web\View $this
 * @var frontend\models\Achievement $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="achievement-form">

    <?php $form = ActiveForm::begin([
		'id'=>'create-achievement-form',
    	'action'=>'/achievement/create',
    	'beforeSubmit' => 'submitForm'
    ]); ?>
	 <div class="col-lg-8">
		<div class="row">
			<div class="col-lg-6">
				<?= $form->field($model, 'achieve_time')->textInput(['maxlength' => 6])->label(Yii::t('achievement', 'When?')) ?>
			</div>
			<div class="col-lg-6">
				<?= $form->field($model, 'time_unit')->dropDownList(User::getTimeUnitOptions())->label(Yii::t('achievement', 'Time Unit?')) ?>
			</div>
		</div>
		 <div class="row">
	    	<div class="col-lg-12"><?= $form->field($model, 'content')->textArea(['rows' => 5])->label(Yii::t('achievement', 'What\'s your achievement?')) ?></div>
		</div>
		<div class="row">
		    <div class="form-group pull-right create-ach-button">
		        <?= Html::submitButton(Yii::t('achievement', 'Create'), ['class' => 'btn btn-success','id'=>'create-achievement']) ?>
		    </div>
		</div>
	</div>
    <?php ActiveForm::end(); ?>
	<?php
	    Modal::begin([
	            'id' => 'restmodal',
	            'header' => '<h4>'.Yii::t('achievement', 'Tips').'</h4>',
	            'closeButton' => ['label' => '<h4>X</h4>'],
	        ]);
	    
	    echo "<div id='modalContent'><h4>".Yii::t('achievement', 'Have a rest now and get a cup of tea!')."</h4></div>";
	 
	    Modal::end();
	    
	    Modal::begin([
		    'id' => 'contentmodal',
		    'header' => '<h4>'.Yii::t('achievement', 'Tips').'</h4>',
		    'closeButton' => ['label' => '<h4>X</h4>'],
	    ]);
	     
	    echo "<div id='modalContent'><h4>".Yii::t('achievement', 'Your already have a same achievement!')."</h4></div>";
	    
	    Modal::end();
    ?>
</div>
