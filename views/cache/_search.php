<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\search\CacheSearch $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="d-flex align-items-end cache-search mb-3">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => ActiveForm::LAYOUT_INLINE,
        'options' => [
            'class' => 'row g-3'
        ],
        'fieldConfig' => ['options' => ['class' => 'col']]
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'expire') ?>

    <?= $form->field($model, 'data') ?>

    <div class="col">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>