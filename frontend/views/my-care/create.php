<?php
use frontend\assets\MyCareAsset;
/**
 * @var yii\web\View $this
 * @var frontend\models\MyCare $model
 */

$this->title = Yii::t('my-care', 'Create My Care People');
MyCareAsset::register($this);
?>
<div class="my-care-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
