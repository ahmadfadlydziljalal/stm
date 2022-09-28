<?php

return [
    'traceLevel' => YII_DEBUG ? 3 : 0,
    'targets' => [
        [
            'class' => yii\mongodb\log\MongoDbTarget::class,
            'levels' => ['error', 'warning'],
        ],
    ],
];