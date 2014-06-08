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
use yii\helpers\Json;
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
    	$model->user_id = $userId;
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
    	$Directroy = Yii::$app->params['userFacePath'];//读取用户头像上传路径
    	//创建文件存放路径
    	$y  = date('Y');
    	$m  = date('m');
    	$d  = date('d');
    	$Directroy = $Directroy."/";
    	$pathd = $Directroy.$y."/".$m."/".$d."/";
    	Tool::makedir(dirname(Yii::app()->BasePath).$pathd); //创建文件夹,此处一定要加上dirname(Yii::app()->BasePath)不然可能会出错;
    	if(is_object($tmpFile) && get_class($tmpFile)==='CUploadedFile'){
    		$filename = time().rand(0,9);
    		$ext = $tmpFile->extensionName;//上传文件的扩展名
    		if($ext=='jpg'||$ext=='gif'||$ext=='png'){
    			$big                    = $pathd . $filename . '_600.' . $ext;
    			$model->face_name       = $big ;
    		}
    		$uploadfile = $pathd . $filename . '.' . $ext;      //保存的路径
    		$model->face_file = $uploadfile;
    		$model->face_url = dirname(Yii::app()->BasePath).$uploadfile;
    		$model->face_type = '1';
    		$model->file_type   = $tmpFile->type;                       //文件类型
    		$model->file_size   = $tmpFile->size;                       //文件大小
    		$model->upload_ip          = Yii::app()->request->userHostAddress; //上传IP
    	}
    	if($model->save()){
    		$tmpFile->saveAs($model->face_url);//保存到服务器
    		$result = Json::encode([
    				'upfile'=>[
    					'id'=>Yii::app()->db->getLastInsertID(),
    					'file'=>$uploadfile,
					]
			]);
    	} 
    }
}
