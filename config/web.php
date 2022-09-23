<?php

use yii\bootstrap5\LinkPager as Bs5LinkPager;
use yii\data\Pagination;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;

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
        'request' => require __DIR__ . '/request.php',
        'session' => require __DIR__ . '/session.php',
        'settings' => require __DIR__ . '/settings.php',
        'user' => require __DIR__ . '/user.php',
        'urlManager' => require __DIR__ . '/url_manager.php',
        'view' => require __DIR__ . '/view.php',
        'pdf' => require __DIR__ . '/pdf.php',
        'pdfWithLetterhead' => require __DIR__ . '/pdf_with_letterhead.php',
    ],
    'container' => [
        'definitions' => [
            Pagination::class => ['pageSize' => 10],
            LinkPager::class => Bs5LinkPager::class,
            GridView::class => [
                'headerRowOptions' => [
                    'class' => 'text-nowrap text-center'
                ],
                'rowOptions' => [
                    'class' => 'text-nowrap'
                ],
                'tableOptions' => [
                    'class' => 'table table-bordered table-grid-view'
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
            ],
            ActionColumn::class => [
                'header' => 'Aksi',
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            DetailView::class => [
                'options' => [
                    'class' => 'table table-bordered table-detail-view'
                ]
            ]
        ]
    ],
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
        ],
    ];
}

return $config;