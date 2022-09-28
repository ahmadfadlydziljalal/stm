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
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'expire',
        'format' => 'datetime',
        'contentOptions' => [
            'class' => 'text-nowrap',
            'style' => [
                'width' => '2px',
            ]
        ]
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'data',
        'format' => 'raw',
        'contentOptions' => [
            'class' => 'text-wrap',
            'style' => [
                'max-width' => '36rem',
            ]
        ]
    ],
    [
        'class' => 'yii\grid\ActionColumn',
    ],
];   