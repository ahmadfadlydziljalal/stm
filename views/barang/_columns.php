<?php

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
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'nama',
        'format'=>'text',
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'part_number',
        'format'=>'text',
    ],
    [
        'class' => 'yii\grid\ActionColumn',
    ],
];   