<?php

namespace app\controllers\admin;

use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use app\controllers\AdminController;
use app\models\User;

class UsersController extends AdminController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCreate()
    {
        $model = new User();
        $model->scenario = 'admin_create';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'admin_update';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
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