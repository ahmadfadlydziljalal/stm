<?php

use mdm\admin\components\Helper;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Faktur */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fakturs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faktur-view">

    <div class="d-flex justify-content-between flex-wrap mb-3 mb-md-3 mb-lg-0" style="gap: .5rem">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="d-flex flex-row flex-wrap align-items-center" style="gap: .5rem">

            <?= Html::a('Kembali', Yii::$app->request->referrer, ['class' => 'btn btn-outline-secondary']) ?>
            <?= Html::a("<i class='bi bi-printer'></i>" . ' Print', ['pdf', 'id' => $model->id], [
                'class' => 'btn btn-outline-primary',
                'target' => '_blank'
            ]) ?>
            <?= Html::a('Index', ['index'], ['class' => 'btn btn-outline-primary']) ?>
            <?= Html::a('Buat Lagi', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) ?>
            <?php
            if (Helper::checkRoute('delete')) :
                echo Html::a('Hapus', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-outline-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]);
            endif;
            ?>
        </div>
    </div>

    <?php try {
        echo DetailView::widget([
            'model' => $model,
            'options' => [
                'class' => 'table table-bordered table-detail-view'
            ],
            'attributes' => [
                'tanggal_faktur:date',
                'nomor_faktur',
                'nomor_purchase_order',
                'jenis_transaksi_id',
            ],
        ]);

        echo Html::tag('h2', 'Faktur Detail');
        echo !empty($model->fakturDetails) ?
            GridView::widget([
                'dataProvider' => new ArrayDataProvider([
                    'allModels' => $model->fakturDetails
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
                        'class' => '\yii\grid\DataColumn',
                        'attribute' => 'barang_id',
                    ],
                    [
                        'class' => '\yii\grid\DataColumn',
                        'attribute' => 'quantity',
                    ],
                    [
                        'class' => '\yii\grid\DataColumn',
                        'attribute' => 'satuan_id',
                    ],
                    [
                        'class' => '\yii\grid\DataColumn',
                        'attribute' => 'harga_barang',
                    ],
                ]
            ]) :
            Html::tag("p", 'Faktur Detail tidak tersedia', [
                'class' => 'text-warning font-weight-bold p-3'
            ]);
    } catch (Exception $e) {
        echo $e->getMessage();
    } catch (Throwable $e) {
        echo $e->getMessage();
    }
    ?>

</div>