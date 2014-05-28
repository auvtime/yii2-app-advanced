<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
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
}
