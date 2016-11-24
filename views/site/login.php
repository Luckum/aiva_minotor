<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('base', 'Вход');
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('base', 'Войти'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
            <a href="<?= Url::to(['/']); ?>" data-method="post"><?= Yii::t('base', 'На главную') ?></a>
            <a href="<?= Url::to(['/registration']); ?>" data-method="post"><?= Yii::t('base', 'Регистрация') ?></a>
        </div>
    </div>
</div>
