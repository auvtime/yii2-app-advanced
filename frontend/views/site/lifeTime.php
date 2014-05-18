<?php
use frontend\assets\LifeTimeAsset;
/**
 *
 * @var yii\web\View $this
 */
$lifeTimeTitle = \Yii::t ( 'auvtime-lifetime', 'Life Time' );
$this->title = $lifeTimeTitle;
$this->params ['breadcrumbs'] [] = $this->title;
LifeTimeAsset::register ( $this );
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo \Yii::t('auvtime', 'Pay will harvest,you git us a little,we will give you more back');?>!</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6">
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title"><?php echo \Yii::t('auvtime-lifetime', 'Your\'s information you gived us.')?></h3>
							</div>
							<div class="panel-body">
								<table
									class="table table-striped table-bordered table-hover table-responsive">
									<tr>
										<td><?php echo \Yii::t('auvtime', 'username');?>:</td>
										<td><?= $model->username?></td>
									</tr>
									<tr>
										<td><?php echo \Yii::t('auvtime', 'email');?>:</td>
										<td><?= $model->email?></td>
									</tr>
									<tr>
										<td><?php echo \Yii::t('auvtime', 'birthday');?>:</td>
										<td><?= $model->getUserBirdyDay()?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="panel panel-success">
							<div class="panel-heading">
								<h3 class="panel-title"><?php echo \Yii::t('auvtime-lifetime', 'Your\'s life time we give you now.')?></h3>
							</div>
							<div class="panel-body">
								<div class="life-time-container">
									<div class="life-time"><?php echo $model->getLifeTimeDisplay()?></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

