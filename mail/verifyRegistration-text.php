<?php

/* @var $this yii\web\View */
/* @var $user app\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['/activate', 'verify_code' => $user->verify_code]);
?>
Привет <?= $user->login ?>,

<?= Yii::t('base', 'Для активации аккаунта пройдите по ссылке:'); ?>

<?= $verifyLink; ?>
