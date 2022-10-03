<?php

use app\components\helpers\ArrayHelper;
use app\models\Barang;
use app\models\JenisTransaksi;
use app\models\Satuan;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Faktur */
/* @var $modelsDetail app\models\FakturDetail */
/* @var $form yii\bootstrap5\ActiveForm */
?>

<div class="faktur-form">

    <?php $form = ActiveForm::begin([
        'id' => 'dynamic-form',
        'layout' => ActiveForm::LAYOUT_HORIZONTAL,
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-4 col-form-label',
                'offset' => 'offset-sm-4',
                'wrapper' => 'col-sm-8',
                'error' => '',
                'hint' => '',
            ],
        ],

        /*'layout' => ActiveForm::LAYOUT_FLOATING,
        'fieldConfig' => [
            'options' => [
            'class' => 'form-floating'
            ]
        ]*/
    ]); ?>

    <div class="d-flex flex-column mt-0" style="gap: 1rem">

        <div class="form-master">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <?= $form->field($model, 'tanggal_faktur')->widget(DateControl::class, [
                        'type' => kartik\datecontrol\DateControl::FORMAT_DATE,
                        'options' => [
                            'autofocus' => 'autofocus'
                        ]
                    ]) ?>
                    <?= $form->field($model, 'nomor_purchase_order')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'jenis_transaksi_id')->radioList(ArrayHelper::map(
                        JenisTransaksi::find()->all(),
                        'id',
                        'nama'
                    )) ?>
                </div>
            </div>
        </div>

        <div class="form-detail">

            <?php
            DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper',
                'widgetBody' => '.container-items',
                'widgetItem' => '.item',
                'limit' => 100,
                'min' => 1,
                'insertButton' => '.add-item',
                'deleteButton' => '.remove-item',
                'model' => $modelsDetail[0],
                'formId' => 'dynamic-form',
                'formFields' => ['id', 'faktur_id', 'barang_id', 'quantity', 'satuan_id', 'harga_barang',],
            ]);
            ?>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="6">Faktur detail</th>
                    </tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Barang</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Harga barang</th>
                        <th scope="col" style="width: 2px">Aksi</th>
                    </tr>
                    </thead>

                    <tbody class="container-items">

                    <?php foreach ($modelsDetail as $i => $modelDetail): ?>
                        <tr class="item">

                            <td style="width: 2px;" class="align-middle">
                                <?php if (!$modelDetail->isNewRecord) {
                                    echo Html::activeHiddenInput($modelDetail, "[$i]id");
                                } ?>
                                <i class="bi bi-arrow-right-short"></i>
                            </td>

                            <td>
                                <?= $form->field($modelDetail, "[$i]barang_id", ['template' =>
                                    '{input}{error}{hint}', 'options' => ['class' => null]])
                                    ->widget(Select2::class, [
                                        'data' => ArrayHelper::map(Barang::find()->all(), 'id', function ($model) {
                                            /** @var Barang $model */
                                            return $model->part_number . ' - ' . $model->nama;
                                        }),
                                        'options' => [
                                            'prompt' => '= Pilih barang ='
                                        ]
                                    ])
                                ?>
                            </td>
                            <td><?= $form->field($modelDetail, "[$i]quantity", ['template' =>
                                    '{input}{error}{hint}', 'options' => ['class' => null]]); ?></td>
                            <td><?= $form->field($modelDetail, "[$i]satuan_id", ['template' =>
                                    '{input}{error}{hint}', 'options' => ['class' => null]])
                                    ->dropDownList(
                                        ArrayHelper::map(Satuan::find()->all(), 'id', 'nama')
                                    ); ?></td>
                            <td><?= $form->field($modelDetail, "[$i]harga_barang", ['template' =>
                                    '{input}{error}{hint}', 'options' => ['class' => null]]); ?></td>

                            <td>
                                <button type="button" class="remove-item btn btn-link text-danger">
                                    <i class="bi bi-trash"> </i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>

                    <tfoot>
                    <tr>
                        <td class="text-end" colspan="5">
                            <?php echo Html::button('<span class="bi bi-plus-circle"></span> Tambah', ['class' => 'add-item btn btn-success',]); ?>
                        </td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <?php DynamicFormWidget::end(); ?>
        </div>

        <div class="d-flex justify-content-between">
            <?= Html::a(' Tutup', ['index'], ['class' => 'btn btn-secondary']) ?>
            <?= Html::submitButton(' Simpan', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>