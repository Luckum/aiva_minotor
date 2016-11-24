<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['/activate', 'verify_code' => $user->verify_code]);
?>
<div>
    <p>Привет <?= Html::encode($user->login) ?>,</p>

    <p><?= Yii::t('base', 'Для активации аккаунта пройдите по ссылке:') ?></p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
