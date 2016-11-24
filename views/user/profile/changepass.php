<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<ol class="breadcrumb">
    <li><a href="<?= Url::to(['/']); ?>"><i class="fa fa-home"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Главная'); ?></a></li>
    <li><a href="<?= Url::to(['user/dashboard']); ?>"><i class="fa fa-dashboard"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Панель управления'); ?></a></li>
    <li><a href="<?= Url::to(['user/profile']); ?>"><i class="fa fa-user"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Личный кабинет'); ?></a></li>
    <li class="active"><i class="fa fa-key"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Сменить пароль') ?></li>
</ol>

<h1 class="page-header"><?= Yii::t('base', 'Сменить пароль') ?></h1>

<div class="user-create">
    
</div>

<div class="user-form">
    <?php $form = ActiveForm::begin(['id' => 'change-pass-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="col-xs-4">
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'new_password')->passwordInput() ?>
            <?= $form->field($model, 'new_password_2')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('base', 'Сменить'), ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('base', 'Назад'), ['user/profile'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
