<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 */

$this->title = Yii::t('auvtime', 'View profile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('auvtime', 'View profile')];
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('auvtime-myprofile', 'Edit'), ['edit', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
	<div class="row">
		<div class="col-lg-6">
		    <?= DetailView::widget([
		        'model' => $model,
		        'attributes' => [
		            'username',
		            'nickname',
		            [
						'label'=>Yii::t('auvtime-myprofile', 'Birthday'),
					 	'value'=>$model->getUserBirthday(),
					],
		            'public_flag',
		            'leave_age',
		            'time_unit',
		            'mobile',
					'email:email',
		            'face',
		            'create_time',
		            'update_time',
		        ],
		    ]) ?>
    	</div>
	</div>
</div>
