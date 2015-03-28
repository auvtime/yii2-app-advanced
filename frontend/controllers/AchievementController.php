<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Achievement;
use frontend\models\AchievementSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\HttpException;
use yii\db\Exception;
use common\models\User;
use frontend\models\UserFace;
/**
 * 
 * <p><b>标题：</b>frontend\controllers$AchievementController.</p>
 *
 * <p><b>描述：我的成就</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-7 下午12:27:47
 *
 * @since 1.0
 */
class AchievementController extends Controller
{
    public function behaviors() {
		return [ 
				'access' => [ 
						'class' => AccessControl::className (),
						'only' => [ 
								'view',
								'index',
								'create',
								'update' 
						],
						'rules' => [ 
								[ 
										'actions' => [ 
												'view',
												'index',
												'create',
												'update' 
										],
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
     * 成就首页
     * 
     * @return string
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-7 下午1:39:38
     */
    public function actionIndex()
    {
        $searchModel = new AchievementSearch;
        $searchModel->user_id=Yii::$app->user->id;
        $dataProvider = $searchModel->search(null);
        $achlist = $dataProvider->getModels();
        $json = Json::encode($achlist);
        Yii::info($json,'auvtime');
        $currentUserId = Yii::$app->user->id;
        $currentUser = User::findIdentity($currentUserId);
        $userFace = UserFace::findOne([
        		'user_id' => $currentUserId,
        		'face_type' => '1',
        		]);
        $currentUser->face = isset($userFace)?$userFace->face_url:'';
        return $this->render('index', [
            'achlist' => $achlist,
        	'currentUser' => $currentUser,
        ]);
    }

    /**
     * Displays a single Achievement model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * ajax添加成就
     * 
     * @throws HttpException
     * @return multitype:string 
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-7 下午2:59:12
     */
    public function actionCreate()
    {
    	if(!Yii::$app->request->isAjax){
    		throw new HttpException('404');
    	}
    	
        $model = new Achievement;
        $model->user_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	$model->refresh();
        	$model->create_time = $model->getCreatTimeDisplay();
        	$model->achieve_time = $model->getAchieveTimeDisplay();
        	Yii::$app->response->format = 'json';
        	$modelJson = Json::encode($model);
        	Yii::info($modelJson,'auvtime');
        	return [
        		'message' => $modelJson,
        	];
        }
    }

    /**
     * Updates an existing Achievement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * ajax删除
     * 
     * @return Ambigous <\yii\web\Response, \yii\web\static, \yii\web\Response>
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-7 下午3:22:30
     */
    public function actionDelete()
    {
    	if(!Yii::$app->request->isAjax){
    		throw new HttpException('404');
    	}
    	$aid = Yii::$app->request->post('aid');
    	$delAch = $this->findModel($aid);
    	$delUserId = $delAch->user_id;
    	$errMsg = '';
    	if($delUserId!==Yii::$app->user->id){
    		echo Yii::t('achievement', 'You have no right to delete other\'s achievement.');
    	}else{
    		try{
    			$delAch->delete();
    			$errMsg = 'success';
    		}catch (Exception $e){
    			$errMsg = $e->__toString();
    		}
    		echo $errMsg;
    	}
    }

    /**
     * Finds the Achievement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Achievement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Achievement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * 判断是否存在相同的成就
     * 
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-7 下午2:41:18
     */
    public function actionContentExists(){
    	$searchModel = new AchievementSearch();
    	$searchModel->user_id=Yii::$app->user->id;
    	$dataProvider = $searchModel->searchAchByTimeAndContent(Yii::$app->request->post());
    	$explist = $dataProvider->getModels();
    	Yii::$app->response->format = 'json';
    	if(empty($explist)){
    		echo 'notexists';
    	}else{
    		echo 'exists';
    	}
    }
}
