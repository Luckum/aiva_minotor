<?php

use yii\helpers\Url;
use yii\helpers\Html;

?>
<ol class="breadcrumb">
    <li><a href="<?= Url::to(['/']); ?>"><i class="fa fa-home"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Главная'); ?></a></li>
    <li><a href="<?= Url::to(['admin/dashboard']); ?>"><i class="fa fa-dashboard"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Панель управления'); ?></a></li>
    <li><a href="<?= Url::to(['admin/users']); ?>"><i class="fa fa-users"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Пользователи'); ?></a></li>
    <li class="active"><i class="fa fa-user-plus"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Редактировать') ?></li>
</ol>

<h1 class="page-header"><?= Yii::t('base', 'Редактировать пользователя') . ' "' . $model->login . '"'; ?></h1>

<div class="user-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
