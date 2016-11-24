<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\models\LoginForm;
use app\models\SignupForm;
use app\controllers\ProtectedController;
use app\models\User;

class SiteController extends ProtectedController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionRegistration()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->session->setFlash('success', Yii::t('base', 'Письмо с кодом активации было выслано на email, указанный при регистрации'));
                return $this->goHome();
            }
        }
        
        return $this->render('registration', [
            'model' => $model,
        ]);
    }
    
    public function actionActivate($verify_code)
    {
        $error = '';
        if (!empty($verify_code)) {
            $model = new User();
            if ($model->activate($verify_code)) {
                Yii::$app->session->setFlash('success', Yii::t('base', 'Ваш аккаунт активирован, можете выполнить вход в систему'));
                return $this->redirect(Yii::$app->user->loginUrl);
            } else {
                $error = Yii::t('base', 'Неверный код подтверждения');
            }
        } else {
            $error = Yii::t('base', 'Неверный код подтверждения');
        }
        return $this->render('activate', [
            'error' => $error,
        ]);
    }
}
