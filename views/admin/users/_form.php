<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Group;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(['id' => 'user-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="col-xs-4">
            <?= $form->field($model, 'login')->textInput() ?>
            <?= $form->field($model, 'email')->textInput() ?>
            <?php if ($model->isNewRecord): ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
            <?php endif; ?>
            <?= $form->field($model, 'name')->textInput() ?>
            <?= $form->field($model, 'group_id')->dropdownList(Group::find()->select(['name'])->indexBy('id')->column()) ?>
            <?= $form->field($model, 'status')->dropdownList($model->getEnumList('status')) ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('base', 'Добавить') : Yii::t('base', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('base', 'Назад'), ['admin/users'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
