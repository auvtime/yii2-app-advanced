<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\UserFace;
use yii\web\UploadedFile;
use auvtime\util\upload\UploadHandler;
use yii\helpers\Json;
use auvtime\util\Lunar;
/**
 * 
 * <p><b>标题：</b>frontend\controllers$MyController.</p>
 *
 * <p><b>描述：我的信息页面</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng 2014-5-25 下午5:38:57
 *
 * @since 1.0
 */
class MyController extends Controller
{
	/**
	 * 只有登录用户才能查看或者编辑信息
	 * @see \yii\base\Component::behaviors()
	 * @return multitype:multitype:multitype:string  multitype:multitype:boolean multitype:string    string  multitype:multitype:multitype:string   string  
	 * @author WangXianfeng 2014-5-26 下午8:37:06
	 */
	public function behaviors() {
		return [ 
				'access' => [ 
						'class' => AccessControl::className (),
						'only' => [ 
								'view',
								'edit' 
						],
						'rules' => [ 
								[ 
										'allow' => true,
										'roles' => [ 
												'@' 
										] 
								] 
						] 
				],
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'delete' => [ 
										'post' 
								] 
						] 
				] 
		];
	}

    /**
     * Displays a single User model.
     * @return mixed
     */
    public function actionView()
    {
    	$userId = Yii::$app->user->id;
        return $this->render('view', [
            'model' => $this->findModel($userId),
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionEdit()
    {
    	$id = Yii::$app->user->id;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //$model->load(Yii::$app->request->post());
            $modelJson = Json::encode($model);
            Yii::info("user-model:".$modelJson,'auvtime');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * 修改用户头像
     * 
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-8 下午2:56:54
     */
    public function actionFace()
    {
    	$userId = Yii::$app->user->id;
    	$model = new UserFace();
    	$model = UserFace::findOne([
				'user_id' => $userId,
    			'face_type' => '1',
    	]);
    	return $this->render('face', [
    		'model' => $model,
    	]);
    }
    /**
     * 上传用户头像图片
     * 
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-8 下午7:39:36
     */
    public function actionUploadFace(){
    	$model = new UserFace();
    	$model->user_id = Yii::$app->user->id;
    	$tmpFile = UploadedFile::getInstanceByName('image');//读取图像上传域,并使用系统上传组件上传
    	$pathd = Yii::$app->params['userFacePath'];//读取用户头像上传路径
    	$pathd = $this->get_server_var('DOCUMENT_ROOT').$pathd.'/';
    	Yii::info('@@@upload_dir:'.$pathd,'auvtime');
    	if(!file_exists($pathd)){
    		mkdir($pathd);
    	}
    	$options = [
    		'upload_dir'=>$pathd,
		];
    	$upload_handler = new UploadHandler($options);
    }
    /**
     * 裁剪头像
     * 
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-15 下午6:00:43
     */
    public function actionCropFace(){
    	//当前用户id
    	$currentUserId = Yii::$app->user->id;
    	
    	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    	//Obtains parameters from POST request
    	$source = $_POST["imageSource"];
    	$viewPortW = $_POST["viewPortW"];
    	$viewPortH = $_POST["viewPortH"];
    	$pWidth = $_POST["imageW"];
    	$pHeight =  $_POST["imageH"];
    	$selectorX = $_POST["selectorX"];
    	$selectorY = $_POST["selectorY"];
    	$sourceImage = explode(".",$_POST["imageSource"]);
    	$ext = end($sourceImage);
    	
    	$serverPath = $this->get_server_var('DOCUMENT_ROOT');
    	//Create the image from the image sent
    	$source = $serverPath.'/'.$source;
    	Yii::info('@@@$source'.$source,'auvtime');
    	$img = new \Imagick($source);
    	//Obtain width and height from the original source.
    	$width = $img->getImageWidth();
    	$height = $img->getImageHeight();
    	
    	//resize the image if the width and height doesn't match
    	if($pWidth != $width && $pHeight != $height){
    		$img->resizeImage($pWidth, $pHeight, \imagick::FILTER_CATROM, 1, false);
    		$width = $img->getImageWidth();
    		$height = $img->getImageHeight();
    	}
    	
    	//Check if we have to rotate the image
    	if($_POST["imageRotate"]){
    		$angle = $_POST["imageRotate"];
    		//rotate the image and set 'transparent' as background of rotation
    		$img->rotateImage(new \ImagickPixel('none'), $angle);
    		$rotated_width = $img->getImageWidth();
    		$rotated_height = $img->getImageHeight();
    	
    		//obtain the difference between sizes so we can move the x,y points.
    		$diffW = abs($rotated_width - $width) / 2;
    		$diffH = abs($rotated_height - $height) / 2;
    	
    		$_POST["imageX"] = ($rotated_width > $width ? $_POST["imageX"] - $diffW : $_POST["imageX"] + $diffW);
    		$_POST["imageY"] = ($rotated_height > $height ? $_POST["imageY"] - $diffH : $_POST["imageY"] + $diffH);
    	
    	}
    	
    	//calculate the position from the source image if we need to crop and where
    	//we need to put into the target image.
    	
    	$dst_x = $src_x = $dst_y = $src_y = 0;
    	
    	if($_POST["imageX"] > 0){
    		$dst_x = abs($_POST["imageX"]);
    	}else{
    		$src_x = abs($_POST["imageX"]);
    	}
    	if($_POST["imageY"] > 0){
    		$dst_y = abs($_POST["imageY"]);
    	}else{
    		$src_y = abs($_POST["imageY"]);
    	}
    	
    	//This fix the page of the image so it crops fine!
    	$img->setimagepage(0, 0, 0, 0);
    	//crop the image with the viewed into the viewport
    	$img->cropImage($viewPortW, $viewPortH, $src_x, $src_y);
    	
    	//create the viewport to put the cropped image
    	$viewport = new \Imagick();
    	$colorHEX = '#0b5d59';
    	$viewport->newImage($viewPortW, $viewPortH,$colorHEX);
    	$viewport->setImageFormat($ext);
    	$viewport->setImageColorspace($img->getImageColorspace());
    	$viewport->compositeImage($img, $img->getImageCompose(), $dst_x, $dst_y);
    	
    	//crop the selection from the viewport
    	$viewport->setImagePage(0, 0, 0, 0);
    	$viewport->cropImage($_POST["selectorW"],$_POST["selectorH"], $selectorX, $selectorY);
    	
    	$pathd = Yii::$app->params['userFacePath'];//读取用户头像上传路径
    	$targetFile = $pathd.time().'-'.$currentUserId.'.'.$ext;
    	$pathd = $this->get_server_var('DOCUMENT_ROOT').$pathd.'/';
    	Yii::info('@@@userFaceFilePath:'.$pathd.'$viewport image size:'.$viewport->getimagesize(),'auvtime');
    	if(!file_exists($pathd)){
    		mkdir($pathd);
    	}
    	$userFaceFileName =$this->get_server_var('DOCUMENT_ROOT').$targetFile;
    	//save the image into the disk
    	$writeResult = $viewport->writeImage($userFaceFileName);
    	if($writeResult){
    		//首先查找当前用户该种类型的头像是否存在，如果存在则更新url，否则直接保存
    		$userFace = UserFace::findOne(['user_id'=>$currentUserId,'face_type'=>'1']);
    		//$userFace = UserFace::getUserFaceByUserIdAndType($currentUserId, '1');
    		if($userFace === null){
    			$userFace = new UserFace();
    			$userFace->user_id = $currentUserId;
    			$userFace->face_url = $targetFile;
    			$userFace->face_type = '1';
    			$userFace->file_type = $ext;
    			$userFace->file_size = $viewport->getimagesize();
    			$userFace->save();
    		}else{
    			$userFace->face_url = $targetFile;
    			$userFace->save();
    		}
    	}
    	echo $targetFile;
    }
    
    
    protected function get_server_var($id) {
    	return isset($_SERVER[$id]) ? $_SERVER[$id] : '';
    }
    /**
     * 根据阳历生日获取农历生日
     * 
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-9-21 下午1:41:37
     */
    public function actionGetLunarBirthday(){
        $solarBirthday = Yii::$app->request->post('solar-birthday');
        $lunarBirthday = '';
        Yii::info('When get user\'s lunar birthday,the solar birthday is '.$solarBirthday,'auvtime');
        $lunar = new Lunar();
        $lunarBirthday = $lunar->getLunarBirthdayFromSolar($solarBirthday);
        $returnJson = new Json();
        $returnJson = $returnJson->encode(["flag"=>"success",'lunarBirthday'=>$lunarBirthday]);
        Yii::info('When get user\'s lunar birthday,returnJson'.$returnJson,'auvtime');
        return $returnJson;
    }
}
