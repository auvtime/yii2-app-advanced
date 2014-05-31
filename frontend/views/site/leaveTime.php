<?php
use auvtime\widget\LeaveTimeWidget;
use frontend\assets\LeaveTimeAsset;
/**
 *
 * @var yii\web\View $this
 */
$leaveTimeTitle = \Yii::t ( 'auvtime-leavetime', 'Leave Time' );
$this->title = $leaveTimeTitle;
$this->params ['breadcrumbs'] [] = $this->title;
LeaveTimeAsset::register ( $this );
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo \Yii::t('auvtime-leavetime', 'If you can live {0} years old,you can live for {1}.',[empty($model->leave_age)?100:$model->leave_age,$model->getLeaveTimeDays()]);?></h3>
			</div>
			<div class="panel-body">
				<?php echo LeaveTimeWidget::widget();?>
			</div>
		</div>
	</div>
</div>

