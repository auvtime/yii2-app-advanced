<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\assets\My97DatePickerAsset;
use frontend\assets\SignUpBirthdayAsset;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var \frontend\models\SignupForm $model
 */
$signup = \Yii::t('auvtime','signup');
$this->title = $signup;
$this->params['breadcrumbs'][] = $this->title;
My97DatePickerAsset::register($this);
SignUpBirthdayAsset::register($this);
$signupButtonText = \Yii::t('auvtime','signup now');
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?php echo \Yii::t('auvtime', 'Pay will harvest,you git us a little,we will give you more back');?>:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'birthday') ?>
                <div class="form-group">
                    <?= Html::submitButton($signupButtonText, ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>