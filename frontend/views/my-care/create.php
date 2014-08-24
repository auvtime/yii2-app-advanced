<?php
/**
 * @var yii\web\View $this
 * @var frontend\models\MyCare $model
 */

$this->title = Yii::t('my-care', 'Create My Care People');
?>
<div class="my-care-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
