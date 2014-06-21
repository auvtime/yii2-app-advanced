<?php
use frontend\assets\UserFaceAsset;
$this->title = Yii::t ( 'auvtime', 'Edit face' );
$this->params ['breadcrumbs'] [] = $this->title;
UserFaceAsset::register ( $this );
?>
<div id="main" class="row">
	<div class="row">
		<div class="col-lg-8" id="statusMsg"></div>
		<div class="col-lg-8">
			<div class="upload-face-container">
				<div class="col-lg-6">
					<span class="btn btn-success fileinput-button"> <i
						class="glyphicon glyphicon-plus"></i> <span><?php echo Yii::t('auvtime-myprofile', 'Please choose your face image')?></span>
						<input id="fileupload" type="file" name="files"
						data-url="upload-face" multiple />
					</span>
				</div>
				<div class="col-lg-6">
					<div id="progress" class="col-lg-12">
						<div class="bar" style="width: 0%;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-8">
			<div class="row crop">
				<div id="cropzoom_container" class="col-lg-9">
					<img id="userFaceInit" alt="" src="">
				</div>
				<div class="col-lg-3">
					<div id="preview">
						<img id="generated" src="/images/face/preview.gif" />
					</div>
					<div class="clear"></div>
					<div class="page_btn">
						<input type="button" class="btn btn-primary" id="crop"
							value="保存头像" /> 
						<input type="button" class="btn btn-primary"
							id="restore" value="照片复位" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
