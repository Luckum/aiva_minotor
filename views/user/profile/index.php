<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\detail\DetailView;
//use yii\widgets\DetailView;

?>

<ol class="breadcrumb">
    <li><a href="<?= Url::to(['/']); ?>"><i class="fa fa-home"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Главная'); ?></a></li>
    <li><a href="<?= Url::to(['user/dashboard']); ?>"><i class="fa fa-dashboard"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Панель управления'); ?></a></li>
    <li class="active"><i class="fa fa-user"></i><?= '&nbsp;&nbsp;' . Yii::t('base', 'Личный кабинет') ?></li>
</ol>

<h1 class="page-header"><?= Yii::t('base', 'Личный кабинет') ?></h1>

<div class="staff-view">
    <br />
    <?php /*DetailView::widget([
        'model' => $model,
        'attributes' => [
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
    ])*/ ?>
    
    <?= DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'tooltips' => false,
        'hover' => true,
        'mode' => DetailView::MODE_VIEW,
        'fadeDelay' => 0,
        'buttons1' => '{update}',
        'panel' => [
            'heading' => Yii::t('base', 'Данные пользователя'),
            'type' => DetailView::TYPE_PRIMARY,
        ],
        'attributes' => [
            'login',
            'email',
            'name',
        ]
    ]);
    ?>
    
    <?= Html::a(Yii::t('base', 'Сменить пароль'), ['user/profile/changepass'], ['class' => 'btn btn-primary']) ?>
    

</div>
