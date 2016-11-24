<?php

namespace app\controllers\user;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\controllers\UserController;
use app\models\User;

class DashboardController extends UserController
{
    public function actionIndex()
    {
        return $this->render('index', [
            
        ]);
    }
}