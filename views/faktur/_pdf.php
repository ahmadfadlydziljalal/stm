<?php


/* @var $this View */

/* @var $model Faktur */

use app\models\Faktur;
use app\models\FakturDetail;
use app\models\Satuan;
use kartik\grid\GridView;
use kartik\grid\SerialColumn;
use pheme\settings\components\Settings;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;

/** @var Settings $settings */
$settings = Yii::$app->settings;
?>

<div class="faktur-pdf">

    <div style="width: 100%">
        <div style="float: left; width: 40%">

            <table>
                <tr>
                    <td>
                        <?= Html::img(Yii::getAlias('@web') . '/images/logo.jpg', [
                            'width' => '6rem',
                            'height' => 'auto'
                        ]) ?>
                    </td>
                    <td class="text-nowrap">
                        <h1><?= $settings->get('site.name') ?></h1>
                        <?= $settings->get('site.slogan') ?>
                    </td>
                </tr>
            </table>

            <small>
                <?= $settings->get('site.alamat') ?>
            </small>

        </div>

        <div style="float: right; width: 55%">
            <table style="width: 100%">
                <tr>
                    <td class="text-end">Jakarta</td>
                    <td style="width: 1px">:</td>
                    <td><?= Yii::$app->formatter->asDate($model->tanggal_faktur) ?></td>
                </tr>
                <tr>
                    <td class="text-end">Kepada Yth</td>
                    <td style="width: 1px">:</td>
                    <td style="font-weight: bold;">
                        <?= $model->jenisTransaksi->nama ?>, <?= isset($model->card) ?
                            $model->card->nama :
                            ''
                        ?>
                    </td>
                </tr>
            </table>

        </div>
    </div>

    <div style="clear: both"></div>

    <?php $sumSubtotal = $model->sumSubtotal ?>
    <?=
    GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query' => $model->getFakturDetails(),
            'pagination' => false,
            'sort' => false
        ]),
        'layout' => '{items}',
        'tableOptions' => [
            'class' => 'table mt-5'
        ],
        /*'showHeader' => false,*/
        'beforeHeader' => [
            [
                'columns' => [

                    [
                        'content' => 'Faktur No: ' . $model->nomor_faktur,
                        'options' => [
                            'colspan' => 2,
                            'style' => [
                                'color' => 'red',
                                'white-space' => 'nowrap',
                                'width' => '14rem',
                                'min-width' => '14rem',
                            ]
                        ]
                    ],
                    [
                        'content' => 'NO P.O: ' . $model->nomor_purchase_order,
                    ]
                ],
            ]
        ],
        'columns' => [
            // [
            // 'class'=>'\yii\grid\DataColumn',
            // 'attribute'=>'id',
            // ],
            // [
            // 'class'=>'\yii\grid\DataColumn',
            // 'attribute'=>'faktur_id',
            // ],
            [
                'class' => SerialColumn::class,
                'header' => 'No.',
                'headerOptions' => [
                    'class' => 'text-end',
                    'width' => '1% !important',
                    'min-width' => '1% !important',
                ],
                'contentOptions' => [
                    'class' => 'text-end',
                    'width' => '1% !important',
                    'min-width' => '1% !important',
                ]
            ],
            [
                'class' => 'kartik\grid\DataColumn',
                'label' => 'Part Number',
                'attribute' => 'barang_id',
                'value' => function ($model) {
                    /** @var FakturDetail $model */
                    return $model->barang->part_number;
                },
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'style' => [
                        'white-space' => 'nowrap',
                        'width' => '12rem',
                        'min-width' => '12rem',
                    ]
                ],
                'pageSummary' => function () use ($sumSubtotal) {
                    return Html::tag('span', 'Terbilang: ' . Yii::$app->formatter->asSpellout($sumSubtotal), [
                        'font-weight' => 'bold'
                    ]);
                },
                'pageSummaryOptions' => [
                    'colspan' => 5,

                ],
            ],
            [
                'class' => 'kartik\grid\DataColumn',
                'attribute' => 'barang_id',
                'label' => 'Description',
                'value' => function ($model) {
                    /** @var FakturDetail $model */
                    return $model->barang->nama;
                },
                'headerOptions' => [
                    'class' => 'text-center',
                ],
                'contentOptions' => [
                    'class' => 'text-nowrap'
                ]
            ],
            [
                'class' => 'kartik\grid\DataColumn',
                'attribute' => 'quantity',
                'label' => 'Qty',
                'contentOptions' => [
                    'class' => 'text-nowrap'
                ],
                'value' => function ($model) {
                    /** @var FakturDetail $model */
                    return $model->quantity . ' ' . Satuan::findOne($model->satuan_id)->nama;
                },
                'headerOptions' => [
                    'class' => 'text-center'
                ],
            ],
            [
                'class' => 'kartik\grid\DataColumn',
                'headerOptions' => [
                    'class' => 'text-end border-end-0 '
                ],
                'contentOptions' => [
                    'class' => 'text-end border-end-0 '
                ],
                'value' => function ($model) {
                    return Yii::$app->getFormatter()->currencyCode;
                },
                'pageSummaryOptions' => [
                    'class' => 'text-end border-end-0 '
                ]
            ],
            [
                'class' => 'kartik\grid\DataColumn',
                'attribute' => 'harga_barang',
                'label' => 'Unit Price',
                'headerOptions' => [
                    'class' => 'text-end text-nowrap border-start-0'
                ],
                'contentOptions' => [
                    'class' => 'text-end border-start-0'
                ],
                'format' => ['decimal', 2],
                'pageSummary' => false,
                'pageSummaryOptions' => [
                    'class' => 'text-end border-start-0'
                ]
            ],
            [
                'class' => 'kartik\grid\DataColumn',
                'headerOptions' => [
                    'class' => 'text-end border-end-0 '
                ],
                'contentOptions' => [
                    'class' => 'text-end border-end-0 '
                ],
                'value' => function ($model) {
                    return Yii::$app->getFormatter()->currencyCode;
                },
                'pageSummary' => function ($summary, $data) {
                    return Yii::$app->getFormatter()->currencyCode;
                },
                'pageSummaryOptions' => [
                    'class' => 'text-end border-end-0 '
                ]
            ],
            [
                'class' => 'kartik\grid\DataColumn',
                'label' => 'Subtotal',
                'headerOptions' => [
                    'class' => 'text-end border-start-0'
                ],
                'contentOptions' => [
                    'class' => 'text-end border-start-0'
                ],
                'value' => function ($model) {
                    /** @var FakturDetail $model */
                    return $model->subTotal;
                },
                'format' => ['decimal', 2],
                'pageSummary' => true,
                'pageSummaryOptions' => [
                    'class' => 'text-end border-start-0'
                ]
            ]
        ],
        'showPageSummary' => true
    ])
    ?>


    <div class="mt-5" style="width: 100%">
        <div style="float:left; width: 20%">Tanda Terima</div>
        <div style="float:left; width: 35%">
            Pembayaran Melalui Bank
            <table>
                <tr>
                    <th class="text-start">BCA</th>
                    <th>:</th>
                    <th class="text-start">4281 4065 52</th>
                </tr>
                <tr>
                    <th class="text-start">BNI</th>
                    <th>:</th>
                    <th class="text-start">0335 6020 74</th>
                </tr>
                <tr>
                    <th class="text-start">A/N</th>
                    <th>:</th>
                    <th class="text-start">Supriyanto</th>
                </tr>
            </table>
        </div>
        <div style="float:left; width: 20%">Hormat Kami</div>
        <div style="float:left; width: 25%">
            Grand Total<br/>
            <b><?= Yii::$app->getFormatter()->currencyCode ?> <?= Yii::$app->formatter->asDecimal($sumSubtotal, 2) ?></b>
        </div>
    </div>

</div>