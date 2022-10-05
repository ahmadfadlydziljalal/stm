<?php

use yii\helpers\Html;
use yii\helpers\Json;

return [
    [
        'class' => 'yii\grid\SerialColumn',
    ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'id',
    // 'format'=>'text',
    // ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'nama',
        'format' => 'text',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'part_number',
        'format' => 'text',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'satuanHarga',
        'format' => 'raw',
        'value' => function ($model) {
            $item = (Json::decode($model->satuanHarga, true));
            return Html::ul($item, ['item' => function ($item, $index) {
                return Html::tag('li', $index . ' => ' . Yii::$app->formatter->asCurrency($item));
            }]);
        }
    ],
    [
        'class' => 'yii\grid\ActionColumn',
    ],
];   