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
use auvtime\util\upload\UploadHandler;
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
    	$pathd = $Directroy.$y.$m.$d;
    	$pathd = dirname(Yii::$app->BasePath).'/frontend/web'.$pathd.'/';
    	Yii::info('@@@upload_dir:'.$pathd,'auvtime');
    	if(!file_exists($pathd)){
    		mkdir($pathd);
    	}
    	$options = [
    		'upload_dir'=>$pathd,
		];
    	$upload_handler = new UploadHandler($options);
    }
}
