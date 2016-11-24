<?php

namespace app\controllers\admin;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\controllers\AdminController;
use app\models\User;

class DashboardController extends AdminController
{
    public function actionIndex()
    {
        return $this->render('index', [
            
        ]);
    }
}