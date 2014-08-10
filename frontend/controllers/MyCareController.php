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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
     * Deletes an existing MyCare model.
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
}
