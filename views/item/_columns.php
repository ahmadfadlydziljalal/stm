<?php
use yii\helpers\Url;

return [
    [
        'class' => 'yii\grid\SerialColumn',
    ],
        // [
        // 'class'=>'yii\grid\DataColumn',
        // 'attribute'=>'id',
        // 'format'=>'text',
    // ],
    [
        'class'=>'yii\grid\DataColumn',
        'attribute'=>'name',
        'format'=>'text',
    ],
    [
        'class'=>'yii\grid\DataColumn',
        'attribute'=>'tanggal',
        'format'=>'date',
    ],
    [
        'class'=>'yii\grid\DataColumn',
        'attribute'=>'tanggal_waktu',
        'format'=>'datetime',
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'urlCreator' => function($action, $model) {
            return Url::to([
                $action,
                'id' => $model->id
            ]);
        },
    ],

];   