<?php

use app\models\JenisTransaksi;

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
        'class' => 'yii\grid\ActionColumn',
    ],
];   