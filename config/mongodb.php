<?php

use yii\mongodb\Connection;

return [
    'class' => Connection::class,
    'dsn' => getenv('MONGO_DSN'),
    'defaultDatabaseName' => getenv('MONGO_INITDB_DATABASE'),
    'options' => [
        'username' => getenv('MONGO_INITDB_ROOT_USERNAME'),
        'password' => getenv('MONGO_INITDB_ROOT_PASSWORD'),
    ],
//    'enableLogging' => true, // enable logging
//    'enableProfiling' => true, // enable profiling
];