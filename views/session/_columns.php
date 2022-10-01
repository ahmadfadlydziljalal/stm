<?php
return [
    [
        'class' => 'yii\grid\SerialColumn',
    ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'expire',
        'format' => 'datetime'
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'data',
        'contentOptions' => [
            'class' => 'text-wrap',
            'style' => [
                'min-width' => '24em'
            ]
        ]
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'user_id',
        'value' => 'user.username'
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'last_write',
        'format' => 'datetime'
    ],
    [
        'class' => 'yii\grid\ActionColumn',
    ],
];
