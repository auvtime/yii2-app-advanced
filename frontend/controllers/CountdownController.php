<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Countdown;
use frontend\models\CountdownSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * CountdownController implements the CRUD actions for Countdown model.
 */
class CountdownController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'countdown-list'],
                'rules' => [
                    [
                        'actions' => ['index','countdown-list'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
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
     * Lists all Countdown models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CountdownSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Countdown model.
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
     * Creates a new Countdown model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Countdown;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Countdown model.
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
     * Deletes an existing Countdown model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Countdown model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Countdown the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Countdown::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * 倒计时列表
     * 
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-10-18 下午8:16:22
     */
    public function actionCountdownList(){
        $searchModel = new CountdownSearch();
        $searchModel->user_id = Yii::$app->user->id;
        $dataProvider = $searchModel->search(null);
        $count = $dataProvider->count;
        $totalCount = $dataProvider->totalCount;
        $pageCount = $count === 0?0:ceil($totalCount/$count);
        $countdownList = $dataProvider->getModels();
        $json = Json::encode($countdownList);
        Yii::info($json,'auvtime');
        return $this->renderPartial('countdownlist', [
            'countdownList' => $countdownList,
            'pageCount' => $pageCount,
        ]);
    }
}
