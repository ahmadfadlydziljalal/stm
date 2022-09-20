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
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'expire',
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'data',
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'user_id',
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'last_write',
    ],
    [
        'class' => 'yii\grid\ActionColumn',
    ],
];   