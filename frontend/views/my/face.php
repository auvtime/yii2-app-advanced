<?php
use frontend\assets\UserFaceAsset;
$this->title = Yii::t ( 'auvtime', 'Edit face' );
$this->params ['breadcrumbs'] [] = $this->title;
UserFaceAsset::register ( $this );
?>
<div id="main row">
	<div class="row">
		<div class="col-lg-8" id="statusMsg"></div>
		<div class="col-lg-8">
			<div class="upload-face-container">
				<div id="progress" class="col-lg-12 hidden">
					<div class="bar" style="width: 0%;"></div>
				</div>
				<div class="col-lg-6">
					<span class="btn btn-success fileinput-button">
				        <i class="glyphicon glyphicon-plus"></i>
				        <span><?php echo Yii::t('auvtime-myprofile', 'Please choose your face image')?></span>
						<input id="fileupload" type="file" name="files"
							data-url="upload-face" multiple/>
					</span>
					<!-- The file name of user face -->
   					<div id="userfacefilename" class="files"></div>
				</div>
				<div class="col-lg-6">
					<input type="button" name="fileuploadBtn" id="fileuploadBtn"
						value="上传头像" class="btn btn-primary hidden" />
				</div>
			</div>
		</div>
	</div>
</div>
