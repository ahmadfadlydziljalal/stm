<?php

use app\models\JenisTransaksi;
use yii\helpers\Html;

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
        'attribute' => 'card_id',
        'value' => 'card.nama',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'tanggal_faktur',
        'format' => 'date',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'nomor_faktur',
        'format' => 'text',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'nomor_purchase_order',
        'format' => 'text',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'jenis_transaksi_id',
        'format' => 'text',
        'filter' => JenisTransaksi::find()->map(),
        'value' => 'jenisTransaksi.nama',
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'value' => function ($model) {
            return Yii::$app->getFormatter()->currencyCode;
        },
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'label' => 'Total',
        'contentOptions' => [
            'class' => 'text-end'
        ],
        'format' => ['decimal', '2'],
        'value' => function ($model) {
            return $model->sumSubtotal;
        }
    ],
    [
        'class' => 'app\components\grid\ActionColumn',
        'template' => '{print} {update} {view} {delete}',
        'buttons' => [
            'print' => function ($url, $model) {
                return Html::a('<i class="bi bi-printer-fill"></i>', ['faktur/pdf', 'id' => $model->id], [
                    'target' => '_blank'
                ]);
            },
        ],
    ],
];   