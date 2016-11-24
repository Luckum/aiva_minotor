<?php

use yii\helpers\Url;

$this->title = Yii::$app->params['name'] . ' | ' . Yii::t('base', 'Панель управления' );
?>

<ol class="breadcrumb">
    <li><a href="<?= Url::to(['/']); ?>"><i class="fa fa-home"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Главная'); ?></a></li>
    <li><a href="<?= Url::to(['user/dashboard']); ?>"><i class="fa fa-dashboard"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Панель управления'); ?></a></li>
    <li class="active"><i class="fa fa-area-chart"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Главная панель') ?></li>
</ol>

<h1 class="page-header"><?= Yii::t('base', 'Главная панель') ?></h1>