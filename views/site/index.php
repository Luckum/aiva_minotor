<?php

use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = Yii::t('base', 'Aiva Prices Monitor');
?>
<div class="site-index">
    <?php if (Yii::$app->user->isGuest) : ?>
        <a href="<?= Url::to(['/login']); ?>" data-method="post"><?= Yii::t('base', 'Вход') ?></a>
    <?php else: ?>
        <a href="<?= Url::to(['/logout']); ?>" data-method="post"><?= Yii::t('base', 'Выход') . '&nbsp;' . '(' . Yii::$app->user->identity->login . ')'; ?></a>
    <?php endif; ?>
    <a href="<?= Url::to(['/registration']); ?>" data-method="post"><?= Yii::t('base', 'Регистрация') ?></a>
    
    <div class="jumbotron">
        <h1>Landing page?</h1>
    </div>
    
    <a href="<?= Url::to(['user/dashboard']); ?>" data-method="post"><?= Yii::t('base', 'Юзер') ?></a>
    <a href="<?= Url::to(['admin/dashboard']); ?>" data-method="post"><?= Yii::t('base', 'Админ') ?></a>

    <div class="body-content">

        <div class="row">
            
        </div>

    </div>
</div>
