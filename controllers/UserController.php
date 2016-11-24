<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use app\controllers\ProtectedController;

class UserController extends ProtectedController
{
    public $publicActions = [
        
    ];

    public function beforeAction($action)
    {
        if (!Yii::$app->user->isGuest) {
            $this->layout = "@app/views/layouts/user";
            return true;
        } else {
            $this->redirect(Yii::$app->user->loginUrl);
        }

        return parent::beforeAction($action);
    }

}
