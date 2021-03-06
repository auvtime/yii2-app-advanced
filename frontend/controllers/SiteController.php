<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','lifeTime'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','lifeTime'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
    	
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
        	$model = Yii::$app->user->identity;
            return $this->render('lifeTime', [
                'model' => $model,
            ]);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        	Yii::info(Yii::$app->params['adminEmail'],'auvtime');
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', Yii::t('contact','Thank you for contacting us. We will respond to you as soon as possible.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('contact','There was an error sending email.'));
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', \Yii::t('auvtime', 'Check your email for further instructions.'));
            } else {
                Yii::$app->getSession()->setFlash('error', \Yii::t('auvtime', 'Sorry, we are unable to reset password for email provided.'));
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', \Yii::t('auvtime', 'New password was saved.'));
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    
    /**
     * 查看生命长度
     * 
     * @author WangXianfeng 2014-5-16 上午9:47:45
     */
    public function actionLifeTime() {
		// 如果用户未登录，则进入到登录界面
		if (\Yii::$app->user->isGuest) {
			return $this->actionLogin ();
		}
		// 如果用户已经登录，则获取用户信息
		$model = Yii::$app->user->identity;
		return $this->render ( 'lifeTime', [ 
				'model' => $model 
		] );
	}
	/**
	 * 查看生命倒计时
	 * 
	 * @return Ambigous <string, \yii\web\Response, \yii\web\static, \yii\web\Response>|string
	 * @author WangXianfeng 2014-5-22 下午11:27:05
	 */
	public function actionLeaveTime() {
		// 如果用户未登录，则进入到登录界面
		if (\Yii::$app->user->isGuest) {
			return $this->actionLogin ();
		}
		// 如果用户已经登录，则获取用户信息
		$model = Yii::$app->user->identity;
		return $this->render ( 'leaveTime', [ 
				'model' => $model 
		] );
	}
}
