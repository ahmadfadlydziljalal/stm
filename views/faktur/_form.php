<?php

use app\components\helpers\ArrayHelper;
use app\models\Barang;
use app\models\BarangSatuan;
use app\models\Card;
use app\models\FakturDetail;
use app\models\JenisTransaksi;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Faktur */
/* @var $modelsDetail app\models\FakturDetail */
/* @var $form yii\bootstrap5\ActiveForm */
?>

    <div class="faktur-form">

        <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
            /*'layout' => ActiveForm::LAYOUT_HORIZONTAL,
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-4 col-form-label',
                    'offset' => 'offset-sm-4',
                    'wrapper' => 'col-sm-8',
                    'error' => '',
                    'hint' => '',
                ],
            ],*/

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
                    <div class="col-12 col-lg-3">

                        <?= $form->field($model, 'card_id')->widget(Select2::class, [
                            'data' => Card::find()->map(),
                            'options' => [
                                'prompt' => '= Pilih Customer =',
                                'autofocus' => 'autofocus'
                            ],
                        ])->label('Customer') ?>

                    </div>

                    <div class="col-12 col-lg-3">
                        <?= $form->field($model, 'tanggal_faktur')->widget(DateControl::class, [
                            'type' => kartik\datecontrol\DateControl::FORMAT_DATE,

                        ]) ?>
                    </div>
                    <div class="col-12 col-lg-3">
                        <?= $form->field($model, 'nomor_purchase_order')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-12 col-lg-3">
                        <?= $form->field($model, 'jenis_transaksi_id', ['inline' => true])->radioList(ArrayHelper::map(
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

                        <?php /** @var FakturDetail $modelDetail */
                        foreach ($modelsDetail as $i => $modelDetail): ?>
                            <tr class="item">

                                <td style="width: 2px;" class="align-middle">
                                    <?php if (!$modelDetail->isNewRecord) {
                                        echo Html::activeHiddenInput($modelDetail, "[$i]id");
                                    } ?>
                                    <i class="bi bi-arrow-right-short"></i>
                                </td>

                                <td>
                                    <?php
                                    $urlAvailableSatuan = Url::to(['barang/find-available-satuan']);
                                    $js2 = <<<JS

                                    var ini = jQuery(this);
                                    var barangId = ini.val();
                                    
                                    if(barangId){
                                        var row = ini.closest('tr');
                                        var satuanId = row.find('.satuan-id');
                                        var hargaBarang = row.find('.harga-barang');
                                        
                                        hargaBarang.val('');
                                        row.find('.quantity').val('1.00');
                                        
                                        satuanId.empty();
                                        jQuery.post('$urlAvailableSatuan', { barangId : barangId}, function(response){
                                           console.log(response);
                                           satuanId.append(new Option("= Select ... = ", '', false, false));
                                           jQuery.each(response.data, function(el, v){
                                               satuanId.append(new Option(v, el, false, false));
                                           });
                                           satuanId.trigger('change');
                                           satuanId.select2('open');
                                        });
                                    }
                                    
JS;
                                    ?>

                                    <?= $form->field($modelDetail, "[$i]barang_id", ['template' =>
                                        '{input}{error}{hint}', 'options' => ['class' => null]])
                                        ->widget(Select2::class, [
                                            'data' => Barang::find()->map(),
                                            'options' => [
                                                'prompt' => '= Pilih Salah Satu =',
                                                'class' => 'barang-id',
                                                'onchange' => "$js2",
                                            ]
                                        ]);

                                    ?>
                                </td>

                                <td>
                                    <?= $form->field($modelDetail, "[$i]quantity", ['template' =>
                                        '{input}{error}{hint}', 'options' => ['class' => null]])
                                        ->textInput([
                                            'class' => 'form-control quantity',
                                            'type' => 'number'
                                        ]);
                                    ?>
                                </td>

                                <td style="min-width: 150px">
                                    <?php try {
                                        $urlHarga = Url::to(['/barang/find-harga-berdasarkan-satuan']);
                                        $data = [];
                                        if (!$model->isNewRecord) {
                                            $barangSatuan = BarangSatuan::find()
                                                ->select([
                                                    'id' => 'satuan_id',
                                                    'name' => 'satuan.nama'
                                                ])
                                                ->joinWith('satuan', false)
                                                ->where(['barang_id' => $modelDetail->barang_id])
                                                ->asArray()
                                                ->all();
                                            $data = ArrayHelper::map($barangSatuan, 'id', 'name');
                                        }
                                        $js = <<<JS
                                        var ini = jQuery(this);
                                        var satuanId = ini.val();
                                        
                                        if(satuanId){
                                            var row = ini.closest('tr');
                                            var barangId = row.find('.barang-id').val();
                                            var hargaBarang = row.find('.harga-barang');
                                            
                                            hargaBarang.val('');
                                            jQuery.post('$urlHarga', { barangId : barangId, satuanId : satuanId}, function(response){
                                                hargaBarang.val(response.data.harga);
                                            });
                                        }
                                        
                                        
JS;
                                        echo $form->field($modelDetail, "[$i]satuan_id", ['template' =>
                                            '{input}{error}{hint}', 'options' => ['class' => null]])
                                            ->widget(Select2::class, [
                                                'data' => $data,
                                                'options' => [
                                                    'prompt' => '-',
                                                    'class' => 'satuan-id form-control',
                                                    'onchange' => "$js",
                                                ]
                                            ]);

                                    } catch (Exception $e) {
                                        echo $e->getMessage();
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php try {
                                        echo $form->field($modelDetail, "[$i]harga_barang", ['template' => '{input}{error}{hint}', 'options' => ['class' => null]])
                                            ->widget(MaskedInput::class, [
                                                'clientOptions' => [
                                                    'alias' => 'numeric',
                                                    'digits' => 2,
                                                    'groupSeparator' => ',',
                                                    'radixPoint' => '.',
                                                    'autoGroup' => true,
                                                    'autoUnmask' => true,
                                                    'removeMaskOnSubmit' => true
                                                ],
                                                'options' => [
                                                    'class' => 'form-control harga-barang'
                                                ]
                                            ]);
                                    } catch (Exception $e) {
                                        echo $e->getMessage();
                                    }
                                    ?>
                                </td>

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
                                <?php echo Html::button('<span class="bi bi-plus-circle"></span> Tambah', ['class' => 'add-item btn btn-primary',]); ?>
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
                <div>
                    <?= Html::submitButton(' Simpan & Buat Faktur Lainnya', [
                        'class' => 'btn btn-success',
                        'name' => 'create-another',
                        'value' => 'true'
                    ]) ?>
                    <?= Html::submitButton(' Simpan', ['class' => 'btn btn-success']) ?>
                </div>

            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php
$afterInsert = <<<JS
    jQuery('#faktur-card_id').select2('open');
    jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
        var barangId = jQuery(item).find('.barang-id');
        barangId.val('').trigger('change');
      
        var satuanId = jQuery(item).find('.satuan-id');
        satuanId.empty();
    });
JS;

$this->registerJs($afterInsert);