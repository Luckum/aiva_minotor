<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use app\controllers\ProtectedController;

class AdminController extends ProtectedController
{
    public $publicActions = [
        
    ];

    public function beforeAction($action)
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity->isAdmin()) {
                $this->layout = "@app/views/layouts/admin";
                return true;
            } else {
                return $this->goHome();
            }
        } else {
            $this->redirect(Yii::$app->user->loginUrl);
        }

        return parent::beforeAction($action);
    }

}
