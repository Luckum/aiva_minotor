<?php 

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('base', 'Активация');
?>

<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
    <div class="span12">
    <?php if (!empty($error)): ?>
        <div class="alert alert-error">
            <?= $error ?>
        </div>
    <?php endif; ?>
    </div>
</div>

<a href="<?= Url::to(['/login']); ?>" data-method="post"><?= Yii::t('base', 'Вход') ?></a>