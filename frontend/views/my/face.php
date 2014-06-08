<?php
use frontend\assets\UserFaceAsset;
$this->title = Yii::t('auvtime', 'Edit face');
$this->params['breadcrumbs'][] = $this->title;
UserFaceAsset::register($this);
?>
<div id="main row">
	<div class="row">
		<div class="col-lg-8">
			<div class="upload-face-container">
				<form id="fileupload" action="/upload-face" method="POST" enctype="multipart/form-data">
					<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
				    <div class="fileupload-buttonbar">
				        <div class="fileupload-buttons">
				            <!-- The fileinput-button span is used to style the file input field as button -->
				            <span class="fileinput-button">
				                <span>Add files...</span>
				                <input type="file" name="files[]" multiple>
				            </span>
				            <button type="submit" class="start">Start upload</button>
				            <button type="reset" class="cancel">Cancel upload</button>
				            <button type="button" class="delete">Delete</button>
				            <input type="checkbox" class="toggle">
				            <!-- The global file processing state -->
				            <span class="fileupload-process"></span>
				        </div>
				        <!-- The global progress state -->
				        <div class="fileupload-progress fade" style="display:none">
				            <!-- The global progress bar -->
				            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
				            <!-- The extended global progress state -->
				            <div class="progress-extended">&nbsp;</div>
				        </div>
				    </div>
				    <!-- The table listing the files available for upload/download -->
				    <table role="presentation"><tbody class="files"></tbody></table>
				</form>
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