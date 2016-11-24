<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
$this->title = Yii::$app->params['name'] . ' | ' . Yii::t('base', 'Панель управления' );
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= Url::to(['admin/dashboard']); ?>"><?= Yii::$app->params['name']; ?></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Profile</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="<?= Url::to(['/logout']); ?>" data-method="post"><?= Yii::t('base', 'Выход') . '&nbsp;' . '(' . Yii::$app->user->identity->login . ')'; ?></a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li <?php if (Yii::$app->controller->id == 'admin/dashboard'): ?> class="active" <?php endif; ?>><a href="<?= Url::to(['admin/dashboard']); ?>"><?= Yii::t('base', 'Главная панель') ?></a></li>
                <li <?php if (Yii::$app->controller->id == 'admin/users'): ?> class="active" <?php endif; ?>><a href="<?= Url::to(['admin/users']); ?>"><?= Yii::t('base', 'Пользователи'); ?></a></li>
                <li <?php if (Yii::$app->controller->id == 'admin/settings'): ?> class="active" <?php endif; ?>><a href="<?= Url::to(['admin/settings']); ?>"><?= Yii::t('base', 'Настройки'); ?></a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?= $content; ?>
        </div>
    </div>
</div>

<footer id="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::t('base', 'AivaLab') . "&nbsp;" . date('Y') ?></p>
    </div>
</footer>
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
