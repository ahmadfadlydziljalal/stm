<?php


$params = require __DIR__ . '/params.php';

$config = [
    'aliases' => require __DIR__ . '/aliases.php',
    'as access' => require __DIR__ . '/as_access.php',
    'basePath' => dirname(__DIR__),
    'bootstrap' => require __DIR__ . '/bootstrap.php',
    'components' => [
        'assetManager' => require __DIR__ . '/asset_manager.php',
        'authManager' => require __DIR__ . '/auth_manager.php',
        'cache' => require __DIR__ . '/cache.php',
        'db' => require __DIR__ . '/db.php',
        'errorHandler' => require __DIR__ . '/error_handler.php',
        'formatter' => require __DIR__ . '/formatter.php',
        'i18n' => require __DIR__ . '/i18n.php',
        'log' => require __DIR__ . '/log.php',
        'mailer' => require __DIR__ . '/mailer.php',
        'mongodb' => require __DIR__ . '/mongodb.php',
        'request' => require __DIR__ . '/request.php',
        'session' => require __DIR__ . '/session.php',
        'settings' => require __DIR__ . '/settings.php',
        'user' => require __DIR__ . '/user.php',
        'urlManager' => require __DIR__ . '/url_manager.php',
        'view' => require __DIR__ . '/view.php',
        'pdf' => require __DIR__ . '/pdf.php',
        'pdfWithLetterhead' => require __DIR__ . '/pdf_with_letterhead.php',
    ],
    'container' => require __DIR__ . '/container.php',
    'id' => 'basic',
    'modules' => require __DIR__ . '/modules.php',
    'name' => strtoupper(getenv('APP_NAME')),
    'params' => $params,
    'timeZone' => 'Asia/Jakarta',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // 'panels' => [
        // 'mongodb' => [
        // 'class' => 'yii\\mongodb\\debug\\MongoDbPanel',
        // 'db' => 'mongodb', // MongoDB component ID, defaults to `db`. Uncomment and change this line, if you registered MongoDB component with a different ID.
        // ],
        // ],
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', "*"],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', "*"],
        'generators' => [
            'dzilcrud' => [
                'class' => 'app\generators\dzilcrud\generators\Generator',
                'templates' => [
                    'master-details' => '@app/generators/dzilcrud/generators/master_details',
                    'master-details-details' => '@app/generators/dzilcrud/generators/master_details_details',
                ]
            ],
            'mongoDbModel' => [
                'class' => 'yii\mongodb\gii\model\Generator'
            ]
        ],
    ];
}

return $config;