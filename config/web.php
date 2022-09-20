<?php

use yii\grid\SerialColumn;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => strtoupper(getenv('APP_NAME')),
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => require __DIR__ . '/aliases.php',
    'components' => [
        'assetManager' => require __DIR__ . '/asset_manager.php',
        'authManager' => require __DIR__ . '/auth_manager.php',
        'request' => require __DIR__ . '/request.php',
        'cache' => require __DIR__ . '/cache.php',
        'user' => require __DIR__ . '/user.php',
        'errorHandler' => require __DIR__ . '/error_handler.php',
        'formatter' => require __DIR__ . '/formatter.php',
        'mailer' => require __DIR__ . '/mailer.php',
        'log' => require __DIR__ . '/log.php',
        'i18n' => require __DIR__ . '/i18n.php',
        'db' => $db,
        'session' => require __DIR__ . '/session.php',
        'urlManager' => require __DIR__ . '/url_manager.php',
        'view' => require __DIR__ . '/view.php',
    ],
    'container' => [
        'definitions' => [
            yii\data\Pagination::class => ['pageSize' => 10],
            yii\widgets\LinkPager::class => yii\bootstrap5\LinkPager::class,
            yii\grid\GridView::class => [
                'headerRowOptions' => [
                    'class' => 'text-nowrap text-center'
                ],
                'rowOptions' => [
                    'class' => 'text-nowrap'
                ],
                'tableOptions' => [
                    'class' => 'table table-bordered'
                ],
                'layout' =>
                    '<div class="table-responsive">' .
                        "{items}" .
                    '</div>' .
                    '<div class="d-flex flex-column flex-md-row justify-content-center justify-content-md-between border-1 border-top-0 align-items-baseline py-3 m-0">' .
                        "{pager}" .
                        "{summary}" .
                    '</div>',
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last',
                    'prevPageLabel' => '<i class="bi bi-chevron-left small"></i>',
                    'nextPageLabel' => '<i class="bi bi-chevron-right small"></i>',
                    'maxButtonCount' => 3,

                ],
                'summary' => "{begin, number}-{end, number} dari {totalCount, number} {totalCount, plural, one{item} other{items}}",
            ],
            SerialColumn::class => [
                'contentOptions' => [
                    'style' => [
                        'text-align' => 'right'
                    ]
                ],
            ]
        ]
    ],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'viewPath' => '@app/views/mdm',
            'defaultRoute' => '/admin/default',
        ]
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'dark-light-toggle/*'
        ]
    ],
    'params' => $params,
    'timeZone' => 'Asia/Jakarta',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', "*"],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['127.0.0.1', '::1', "*"],
        'generators' => [
            'dzilcrud' => [
                'class' => 'app\generators\dzilcrud\generators\Generator',
                'templates' => [
                    'master-details' => '@app/generators/dzilcrud/generators/masterdetails',
                    'master-details-details' => '@app/generators/dzilcrud/generators/masterdetailsdetails',
                ]
            ],
        ],
    ];
}

return $config;