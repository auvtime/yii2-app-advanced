<?php

/**
 * @var yii\web\View $this
 * @var frontend\models\Countdown $model
 */

$this->title = Yii::t('countdown', 'Create Countdown');
?>
<div class="countdown-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
