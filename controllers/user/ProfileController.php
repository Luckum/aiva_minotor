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
        $model = $this->findModel(Yii::$app->user->identity->id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('kv-detail-success', Yii::t('base', 'Изменения сохранены'));
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }
    
    public function actionChangepass()
    {
        $model = $this->findModel(Yii::$app->user->identity->id);
        $model->scenario = 'changePass';
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('base', 'Пароль изменен'));
            return $this->redirect(['index']);
        }
        
        $model->password = '';
        return $this->render('changepass', [
            'model' => $model,
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