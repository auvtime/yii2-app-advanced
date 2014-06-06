<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Experience;
use frontend\models\ExperienceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\db\Exception;
use yii\web\HttpException;
use frontend\models\Achievement;
use yii\helpers\Html;

/**
 * ExperienceController implements the CRUD actions for Experience model.
 */
class ExperienceController extends Controller
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
     * Lists all Experience models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExperienceSearch;
        $searchModel->user_id=Yii::$app->user->id;
        $dataProvider = $searchModel->search(null);
        $explist = $dataProvider->getModels();
        $json = Json::encode($explist);
        Yii::info($json,'auvtime');
        return $this->render('index', [
            'explist' => $explist,
        ]);
    }

    /**
     * Displays a single Experience model.
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
     * Creates a new Experience model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Experience;
		$model->user_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	$model->refresh();
        	$model->create_time = $model->getCreatTimeDisplay();
        	$model->exp_time = $model->getExpTimeDisplay();
        	Yii::$app->response->format = 'json';
        	$modelJson = Json::encode($model);
        	Yii::info($modelJson,'auvtime');
        	return [
        		'message' => $modelJson,
        	];
        } 
    }

    /**
     * Updates an existing Experience model.
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
     * Deletes an existing Experience model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
    	if(!Yii::$app->request->isAjax){
    		throw new HttpException('404');
    	}
    	$eid = Yii::$app->request->post('eid');
    	$delExp = $this->findModel($eid);
    	$delUserId = $delExp->user_id;
    	$errMsg = '';
    	if($delUserId!==Yii::$app->user->id){
    		echo Yii::t('experience', 'You have no right to delete other\'s experience.');
    	}else{
    		try{
    			$delExp->delete();
    			$errMsg = 'success';
    		}catch (Exception $e){
    			$errMsg = $e->__toString();
    		}
    		echo $errMsg;
    	}
    }

    /**
     * Finds the Experience model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Experience the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Experience::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
	/**
	 * 判断是否存在相同内容的经历
	 * 
	 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-2 上午11:25:08
	 */
	public function actionContentExists(){
		$searchModel = new ExperienceSearch;
		$searchModel->user_id=Yii::$app->user->id;
		$dataProvider = $searchModel->searchExpByTimeAndContent(Yii::$app->request->post());
		$explist = $dataProvider->getModels();
		Yii::$app->response->format = 'json';
		if(empty($explist)){
			echo 'notexists';
		}else{
			echo 'exists';
		}
	}
	/**
	 * 记入成就
	 * 
	 * @throws HttpException
	 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-5 下午9:24:19
	 */
	public function actionAddToAch(){
		if(!Yii::$app->request->isAjax){
			throw new HttpException('404');
		}
		$eid = Yii::$app->request->post('eid');
		$addToAchExp = $this->findModel($eid);
		$addToAchExpUserId = $addToAchExp->user_id;
		$errMsg = '';
		if($addToAchExpUserId !== Yii::$app->user->id){
			echo Yii::t('experience', 'You have no right to deal other\'s experience.');
		}else{
			try{
				$achievement = new Achievement();
				$achievement->content = $addToAchExp->content;
				$achievement->exp_id = $addToAchExp->id;
				$achievement->achieve_time = $addToAchExp->exp_time;
				$achievement->user_id = $addToAchExp->user_id;
				$achievement->time_unit = $addToAchExp->time_unit;
				$achievement->achieve_time = $addToAchExp->exp_time;
				if($achievement->save()){
					echo $this->getStatusMsg();
				}else{
					$returnMsg = ['flag'=>'fail','msg'=>Yii::t('experience', 'Add this experience to achievement failed!')];
					$returnMsg = Json::encode($returnMsg);
					echo $returnMsg;	
				}
			}catch (Exception $e){
				$errMsg = $e->__toString();
			}
			echo $errMsg;
		}
	}
	
	/**
	 * 获取成功消息
	 * 
	 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-6 下午8:57:59
	 */
	public function getStatusMsg(){
		$statusMsg = Html::beginTag('span',['class'=>'ajax_notification']);
		$statusMsg = $statusMsg.Html::beginTag('div',['class'=>'alert alert-success']);
		$statusMsg = $statusMsg.Html::beginTag('img',['class'=>'icon ic_s_success']);
		$statusMsg = $statusMsg.Html::endTag('img');
		$msg = Yii::t('experience', 'Add experience to achievement success!');
		$statusMsg = $statusMsg.$msg;
		$statusMsg = $statusMsg.Html::endTag('div');
		$statusMsg = $statusMsg.Html::endTag('span');
		$returnMsg = ['flag'=>'success','msg'=>$statusMsg];
		$returnMsg = Json::encode($returnMsg);
		Yii::info($returnMsg,'auvtime');
		return $returnMsg;
	}
}
