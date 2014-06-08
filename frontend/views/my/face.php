<?php
use frontend\assets\UserFaceAsset;
use yii\widgets\ActiveForm;
$this->title = Yii::t('auvtime', 'Edit face');
$this->params['breadcrumbs'][] = $this->title;
UserFaceAsset::register($this);
?>
<div id="main row">
	<div class="row">
		<div class="col-lg-8">
			<div class="file-box">
				<input id="fileupload" type="file" name="image" size="50" multiple>
			</div>
		</div>
	</div>
	<div class="row crop">
		<div id="cropzoom_container"><img id="userFaceOrig" alt="" src=""></div>
		<div id="preview">
			<img id="generated" src="/images/face/head.gif" />
		</div>
		<div class="page_btn">
			<input type="button" class="btn" id="crop" value="剪切照片" /> <input
				type="button" class="btn" id="restore" value="照片复位" />
		</div>
		<div class="clear"></div>
	</div>
</div>