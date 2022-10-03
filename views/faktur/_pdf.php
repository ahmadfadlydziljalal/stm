<?php


/* @var $this View */

/* @var $model Faktur */

use app\models\Faktur;
use app\models\FakturDetail;
use app\models\Satuan;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\web\View;
use yii\widgets\DetailView;


?>

<div class="faktur-pdf">

    <div style="width: 100%">
        <div style="float: left; width: 40%">
            Logo Toko
        </div>
        <div style="float: left; width: 55%">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'tanggal_faktur:date',
                    [
                        'label' => 'Kepada Yth.',
                        'value' => 'Dummy Data'
                    ],
                ],
                'options' => [
                    'style' => [
                        'width' => '100%'
                    ]
                ]
            ])
            ?>
        </div>
    </div>

    <div style="clear: both"></div>

    <?=
    GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query' => $model->getFakturDetails(),
            'pagination' => false
        ]),
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
                'class' => SerialColumn::class
            ],
            [
                'class' => '\yii\grid\DataColumn',
                'attribute' => 'barang_id',
                'label' => 'Part Number',
                'value' => function ($model) {
                    /** @var FakturDetail $model */
                    return $model->barang->part_number;
                }
            ],
            [
                'class' => '\yii\grid\DataColumn',
                'attribute' => 'barang_id',
                'label' => 'Description',
                'value' => function ($model) {
                    /** @var FakturDetail $model */
                    return $model->barang->nama;
                }
            ],
            [
                'class' => '\yii\grid\DataColumn',
                'attribute' => 'quantity',
                'contentOptions' => [
                    'style' => [
                        'text-align' => 'right'
                    ]
                ],
                'value' => function ($model) {
                    /** @var FakturDetail $model */
                    return $model->quantity . ' ' . Satuan::findOne($model->satuan_id)->nama;
                }
            ],
            [
                'class' => '\yii\grid\DataColumn',
                'attribute' => 'harga_barang',
            ],
            [
                'label' => 'amount',
                'value' => function ($model) {
                    /** @var FakturDetail $model */
                    return $model->quantity * $model->harga_barang;
                }
            ]
        ]
    ])
    ?>
</div>