<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\LogSearch $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="d-flex align-items-end log-search mb-3">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => ActiveForm::LAYOUT_INLINE,
        'options' => [
            'class' => 'row g-3'
        ],
        'fieldConfig' => ['options' => ['class' => 'col']]
    ]); ?>

    <?= $form->field($model, '_id') ?>
    <?= $form->field($model, 'level') ?>
    <?= $form->field($model, 'category') ?>
    <?= $form->field($model, 'log_time') ?>
    <?= $form->field($model, 'prefix') ?>

    <div class="col">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>