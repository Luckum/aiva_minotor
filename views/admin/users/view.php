<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>

<ol class="breadcrumb">
    <li><a href="<?= Url::to(['/']); ?>"><i class="fa fa-home"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Главная'); ?></a></li>
    <li><a href="<?= Url::to(['admin/dashboard']); ?>"><i class="fa fa-dashboard"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Панель управления'); ?></a></li>
    <li><a href="<?= Url::to(['admin/users']); ?>"><i class="fa fa-users"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Пользователи'); ?></a></li>
    <li class="active"><i class="fa fa-user-o"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Детали') ?></li>
</ol>

<h1 class="page-header"><?= Yii::t('base', 'Детали пользователя') . ' "' . $model->login . '"'; ?></h1>

<div class="staff-view">

    <p>
        <?= Html::a(Yii::t('base', 'Назад'), ['admin/users'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('base', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('base', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('base', 'Вы уверены, что хотите удалить этот элемент?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'login',
            'email:email',
            'name',
            [
                'label' => $model->getAttributeLabel('group_id'),
                'value' => $model->group->name,
            ],
            'status',
            'creation_date',
        ],
    ]) ?>

</div>
