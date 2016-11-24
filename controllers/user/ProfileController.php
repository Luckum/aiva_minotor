<?php

namespace app\controllers\user;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\controllers\UserController;
use app\models\User;

class ProfileController extends UserController
{
    public function actionIndex()
    {
        return $this->render('index', [
            'model' => $this->findModel(Yii::$app->user->identity->id),
        ]);
    }
    
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}