<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var \frontend\models\ContactForm $model
 */
$contact = \Yii::t('contact', 'Contact');
$this->title = $contact;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php echo \Yii::t('contact', 'If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.')?>
    </p>

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <div class="col-lg-4"><?= $form->field($model, 'name') ?></div>
                <div class="col-lg-4"><?= $form->field($model, 'email') ?></div>
                <div class="col-lg-8"><?= $form->field($model, 'subject') ?></div>
                <div class="col-lg-8"><?= $form->field($model, 'body')->textArea(['rows' => 4]) ?></div>
               	<div class="col-lg-8">
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                </div>
                <div class="col-lg-8">
	                <div class="form-group">
	                    <?= Html::submitButton(\Yii::t('contact', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
	                </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
