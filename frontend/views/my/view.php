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
    <h1><?= Html::encode($this->title) ?>&nbsp;&nbsp;&nbsp;<?= Html::a(Yii::t('auvtime-myprofile', 'Edit'), ['edit'], ['class' => 'btn btn-primary']) ?></h1>
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
		            
					[
						'label'=>Yii::t('auvtime-myprofile', 'Public Flag'),
						'value'=>$model->getPublicFlagOptions()[$model->public_flag],
					],
					[
                        'label'=>Yii::t('auvtime-myprofile', 'Leave Age'),
                        'value'=>$model->leave_age.Yii::t('auvtime-myprofile', ' yeas'),
                    ],
                    [
                        'label'=>Yii::t('auvtime-myprofile', 'Time Unit'),
                        'value'=>$model->getTimeUnitOptions()[$model->time_unit],
                    ],
		            'mobile',
					'email:email',
		    		[
			    		'label'=>Yii::t('auvtime-myprofile', 'Update Time'),
			    		'value'=>Yii::$app->formatter->format($model->update_time, ['dateTime','Y-m-d H:i:s']),
		    		],
		        ],
		    ]) ?>
    	</div>
	</div>
</div>
