<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

?>

<ol class="breadcrumb">
    <li><a href="<?= Url::to(['/']); ?>"><i class="fa fa-home"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Главная'); ?></a></li>
    <li><a href="<?= Url::to(['admin/dashboard']); ?>"><i class="fa fa-dashboard"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Панель управления'); ?></a></li>
    <li class="active"><i class="fa fa-users"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Пользователи') ?></li>
</ol>

<h1 class="page-header"><?= Yii::t('base', 'Пользователи') ?></h1>

<div class="user-index">
    <p>
        <?= Html::a(Yii::t('base', 'Добавить пользователя'), ['admin/users/create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['id' => $model->id, 'style' => "cursor: pointer", 'onclick' => "window.location='" . Url::to(['admin/users/update']) . "/" . $model->id . "'"];
        },
        'columns' => [
            'id',
            'login',
            'email',
            'creation_date',
            [
                'attribute' => 'group_id',
                'content' => function ($data) {
                    return $data->getGroupName();
                }
            ],
            'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        if ($model->id == Yii::$app->user->identity->id) {
                            return '';
                        } else {
                            return '<a href="' . Url::to(['admin/users/delete']) . '/' . $model->id . '" title="' . Yii::t('base', 'Удалить') . '" aria-label="' . Yii::t('base', 'Удалить') . '" data-confirm="' . Yii::t('base', 'Вы уверены, что хотите удалить этот элемент?') . '" data-method="post" data-pjax="0">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>';
                        }
                    }
                ],
            ],
        ],
    ]); ?>
</div>