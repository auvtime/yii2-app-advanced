<?php

namespace frontend\controllers;

use Yii;
use frontend\models\MyCare;
use frontend\models\MyCareSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * MyCareController implements the CRUD actions for MyCare model.
 */
class MyCareController extends Controller {
	public function behaviors() {
		return [ 
				'access' => [ 
						'class' => AccessControl::className (),
						'only' => [
								'index', 
								'view',
								'edit',
						        'care-list', 
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
						'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all MyCare models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MyCareSearch;
        $dataProvider = $searchModel->search(null);
        $count = $dataProvider->count;
        $totalCount = $dataProvider->totalCount;
        $pageCount = $count === 0?0:ceil($totalCount/$count);
        $myCareList = $dataProvider->getModels();
        $json = Json::encode($myCareList);
        Yii::info($json,'auvtime');
        return $this->render('my-care', [
            'myCareList' => $myCareList,
        	'pageCount' => $pageCount,
        ]);
    }

    /**
     * Creates a new MyCare model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	$this->layout = "jmsgbox";
        $model = new MyCare;
        $model->user_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return "success";
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MyCare model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $this->layout = "jmsgbox";
        $request = Yii::$app->request;
        if($request->getIsGet()){
            $careId = $request->getQueryParam('careId');
            $model = $this->findModel($careId);
            return $this->render('update', [
                'model' => $model,
            ]);
        }else if($request->getIsPost()){
            $model = new MyCare();
            $model->load($request->post());
            $json = Json::encode($model);
            Yii::info($json,'auvtime');
            if ($model->save()) {
                return "success";
            }
        }
    }

    /**
     * 删除关心的人，成功返回success，失败返回fail
     * @param string $careId
     * @return string
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-8-30 上午10:56:31
     */
    public function actionDelete()
    {
        $message = 'fail';
        try {
            $careId = Yii::$app->request->post('careId');
            Yii::info("@@@careId:".$careId,'auvtime');
            if($this->findModel($careId)->delete()){
                $message = "success";
            }
        } catch (\Exception $e) {
            Yii::error('删除关心的人的时候发生错误：'.$e->getMessage(),'auvtime');
        }
        return $message;
    }

    /**
     * Finds the MyCare model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MyCare the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MyCare::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * 获取关心的人列表
     * 
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-8-24 下午3:51:41
     */
    public function actionCareList(){
        $searchModel = new MyCareSearch;
        $dataProvider = $searchModel->search(null);
        $count = $dataProvider->count;
        $totalCount = $dataProvider->totalCount;
        $pageCount = $count === 0?0:ceil($totalCount/$count);
        $myCareList = $dataProvider->getModels();
        $json = Json::encode($myCareList);
        Yii::info($json,'auvtime');
        return $this->renderPartial('care-list', [
            'myCareList' => $myCareList,
            'pageCount' => $pageCount,
        ]);
    }
}
