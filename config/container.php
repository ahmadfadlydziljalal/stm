<?php

use yii\bootstrap5\LinkPager as Bs5LinkPager;
use yii\data\Pagination;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;

return [
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
        \kartik\grid\GridView::class => [
            'headerRowOptions' => [
                'class' => 'text-nowrap text-center'
            ],
            'rowOptions' => [
                'class' => 'text-nowrap'
            ],
            'tableOptions' => [
                'class' => 'table table-bordered table-grid-view'
            ],
            'headerContainer' => [],
            'bordered' => false,
            'responsive' => false,
            'responsiveWrap' => false,
            'resizableColumns' => false,
            'striped' => false,
            'exportConfig' => [
                'html' => [],
                'csv' => [],
                'txt' => [],
                'xls' => [],
                'pdf' => [],
                'json' => [],
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
];