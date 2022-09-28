<?php

$params = require __DIR__ . '/params.php';

return [
    // this is the name of the session cookie used for login on the backend
    'name' => $params['sessionName'],
    'timeout' => 86400, // 1 Day
    'class' => 'yii\mongodb\Session', // or 'yii\web\DbSession'
    'cookieParams' => [
        'sameSite' => PHP_VERSION_ID >= 70300 ? yii\web\Cookie::SAME_SITE_LAX : null,
    ],
    'writeCallback' => function ($session) {
        return [
            'user_id' => Yii::$app->user->id,
            'last_write' => time(),
        ];
    }
];