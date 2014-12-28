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
use frontend\models\AchievementSearch;
use frontend\models\UserFace;
use common\models\User;
use auvtime\util\upload\ExpImgUploadHandler;
use Directory;
use frontend\models\ExperiencePicture;

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
    	//分页查询经历列表第一页
        $searchModel = new ExperienceSearch;
        $searchModel->user_id=Yii::$app->user->id;
        $dataProvider = $searchModel->search(null);
        $count = $dataProvider->count;
        $totalCount = $dataProvider->totalCount;
        $pageCount = $count === 0?0:ceil($totalCount/$count);
        $explist = $dataProvider->getModels();
        foreach($explist as &$e){
        	$e->create_time = $e->getCreatTimeDisplay();
        	$e->exp_time = $e->getExpTimeDisplay();
        }
        unset($e);
        $json = Json::encode($explist);
        Yii::info($json,'auvtime');
        //用户头像url
        $currentUserId = Yii::$app->user->id;
        $currentUser = User::findIdentity($currentUserId);
        $userFace = UserFace::findOne([
				'user_id' => $currentUserId,
    			'face_type' => '1',
    	]);
        $currentUser->face = isset($userFace)?$userFace->face_url:'';
        //查询页面导航
        $navList = $searchModel->searchNav(null);
        
        return $this->render('index', [
            'explist' => $explist,
        	'currentUser' => $currentUser,
        	'pageCount' => $pageCount,
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
        	//经历保存成功之后更新经历图片信息中的exp_id字段
        	$expPicIds = Yii::$app->request->post("expPicIds");
        	Yii::info("exp pic ids:".$expPicIds,"auvtime");
        	$ep = new ExperiencePicture();
        	$ep->updateExpId($model->user_id,$model->id,$expPicIds);
        	
        	
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
		$returnMsg = '';
		if($addToAchExpUserId !== Yii::$app->user->id){
			$returnMsg = Yii::t('experience', 'You have no right to deal other\'s experience.');
		}else{
			try{
				//判断是否已经添加到成就，如果已经添加则提示，如果没有则新增
				$achievementSearch = new AchievementSearch();
				$achievementCount = $achievementSearch->searchCountByExpId($addToAchExp->id);
				Yii::info($achievementCount,'auvtime');
				if($achievementCount>0){
					$returnMsg = ['flag'=>'fail','msg'=>Yii::t('experience', 'This experience was added to achievement already!')];
					$returnMsg = Json::encode($returnMsg);
				}else{
					$achievement = new Achievement();
					$achievement->content = $addToAchExp->content;
					$achievement->exp_id = $addToAchExp->id;
					$achievement->achieve_time = $addToAchExp->exp_time;
					$achievement->user_id = $addToAchExp->user_id;
					$achievement->time_unit = $addToAchExp->time_unit;
					$achievement->achieve_time = $addToAchExp->exp_time;
					if($achievement->save()){
						$returnMsg = $this->getStatusMsg();
					}else{
						$returnMsg = ['flag'=>'fail','msg'=>Yii::t('experience', 'Add this experience to achievement failed!')];
						$returnMsg = Json::encode($returnMsg);	
					}
				}
			}catch (Exception $e){
				$returnMsg = ['flag'=>'fail','msg'=>$e->__toString()];
			}
			Yii::info($returnMsg,'auvtime');
			echo $returnMsg;
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
	
	/**
	 * 根据页数自动加载更多，1为第一页
	 * 
	 * @param int $page
	 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-7-11 下午5:22:21
	 */
	public function actionLoadmore($page){
		$page = $page - 1;
		$searchModel = new ExperienceSearch;
        $searchModel->user_id=Yii::$app->user->id;
        $dataProvider = $searchModel->search($page);
        $explist = $dataProvider->getModels();
        foreach($explist as &$e){
        	$e->create_time = $e->getCreatTimeDisplay();
        	$e->exp_time = $e->getExpTimeDisplay();
        }
        unset($e);
        $json = Json::encode($explist);
        echo $json;
	}
	/**
	 * 上传经历图片,每条经历都可以添加图片
	 * 
	 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-12-21 下午12:13:45
	 */
	public function actionUploadExpImg(){
	    $pathd = Yii::$app->params['expImgPath'];//读取用户头像上传路径
	    if(substr($pathd, strlen($pathd)-1,1)=='/'){
	        $pathd = $this->get_server_var('DOCUMENT_ROOT').$pathd;
	    }else{
	        $pathd = $this->get_server_var('DOCUMENT_ROOT').$pathd.'/';
	    }
	    Yii::info('@@@upload_dir:'.$pathd,'auvtime');
	    if(!file_exists($pathd)){
	        mkdir($pathd);
	    }
	    $options = [
	        'upload_dir'=>$pathd
	    ];
	    $upload_handler = new ExpImgUploadHandler($options);
	}
	
	protected function get_server_var($id) {
	    return isset($_SERVER[$id]) ? $_SERVER[$id] : '';
	}
}
