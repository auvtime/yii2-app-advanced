<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var frontend\models\MyCare $model
 */

$this->title = Yii::t('my-care', 'Update My Cared People');
?>
<div class="my-care-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
