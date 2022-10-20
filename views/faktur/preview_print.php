<?php

/** @see \app\controllers\FakturController::actionPdf() */
/** @see \app\controllers\FakturController::actionPreviewPrint() */
/** @see \app\controllers\FakturController::actionPrint() */

/* @var $this View */
/* @var $openWindowPrint int */

/* @var $model Faktur */

use app\components\helpers\ArrayHelper;
use app\models\Faktur;
use pheme\settings\components\Settings;
use yii\helpers\Html;
use yii\web\View;

/** @var Settings $settings */
$settings = Yii::$app->settings;
?>

<?php if ($openWindowPrint): ?>
    <style type="text/css">
        <?php echo file_get_contents(Yii::getAlias('@app') . '/themes/v2/dist/css/print.css') ?>
    </style>
    <script>
        (function () {
            window.print();
            window.onafterprint = function () {
                window.close();
            }
        })();   
    </script>
<?php endif; ?>

<div class="faktur-pdf">

    <div style="width: 100%">
        <div style=" float: left; width: 50%">

            <table>
                <tr>
                    <td style="padding: 0">
                        <?= Html::img(Yii::getAlias('@web') . '/images/logo.jpg', [
                            'width' => '64px',
                            'height' => 'auto'
                        ]) ?>
                    </td>
                    <td class="">
                        <h3 style="margin: 0; padding: 0"><?= $model->tokoSaya->nama ?></h3>
                        <p style="margin: 0; padding: 0; font-size: 10pt"><?= $settings->get('site.slogan') ?></p>
                        <?php if ($model->tokoSaya->kode == 'STM'): ?>
<!--                            <small style="margin: 0; padding: 0">-->
                                <?php //echo $settings->get('site.alamat') ?>
<!--                            </small>-->
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>

        <div style="float: right; width: 48%">
            <table style="width: 100%">
                <tr>
                    <td class="text-end" style="width: 96px">Jakarta</td>
                    <td style="width: 1px">:</td>
                    <td><?= Yii::$app->formatter->asDate($model->tanggal_faktur) ?></td>
                </tr>
                <tr>
                    <td class="text-end" style="vertical-align: top">Kepada Yth</td>
                    <td style="width: 1px; vertical-align: top">:</td>
                    <td style="font-weight: bold;vertical-align: top">
                        <?= isset($model->card) ? $model->card->nama : '' ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div style="clear: both"></div>

    <?php $sumSubtotal = $model->sumSubtotal ?>
    <?php $maxRows = Yii::$app->settings->get('faktur.maximalRowItemInPrintMode'); ?>

    <?php if (!$openWindowPrint) echo Html::beginTag('div', ['class' => 'table-responsive']) ?>
        <table class="table mt-3 kv-grid-table table-bordered">
        <thead class="w0">
        <tr>
            <th colspan="2" style="white-space: nowrap; width: 14rem; min-width: 14rem;">Faktur
                No: <?= $model->nomor_faktur ?></th>
            <th>NO P.O: <?= !empty($model->nomor_purchase_order) ? $model->nomor_purchase_order : "-" ?></th>
        </tr>

        <tr class="text-nowrap text-center">
            <th class="text-end border-top-0 border-end-0" style="width:50px;min-width:1% !important">
                No.
            </th>
            <th class="text-center border-top-0 border-end-0" data-col-seq="1">Part Number</th>
            <th class="text-center border-top-0 border-end-0" data-col-seq="2">Description</th>
            <th class="text-center  border-end-0" data-col-seq="3">Qty</th>
            <th class="text-end  border-end-0 " data-col-seq="4"></th>
            <th class="text-end text-nowrap border-start-0 border-end-0" data-col-seq="5">Unit Price</th>
            <th class="text-end border-end-0" data-col-seq="6"></th>
            <th class="text-end border-start-0" data-col-seq="7">Subtotal</th>
        </tr>
        </thead>
        <tbody class="border-bottom">
            <?php for ($i = 0; $i <= $maxRows; $i++): ?>

            <?php if (!isset($model->fakturDetails[$i])): ?>
                <tr class="text-nowrap">
                    <td class="text-end border-bottom-0 border-top-0 border-end-0"
                        style="width:50px; min-width:1% !important; height: 2.25em"></td>
                    <td class="border-bottom-0 border-top-0 border-end-0 "
                        style="white-space: nowrap; width: 12rem; min-width: 12rem;"></td>
                    <td class="text-nowrap border-bottom-0 border-top-0 border-end-0 "></td>
                    <td class="text-nowrap border-bottom-0 border-top-0 border-end-0 "></td>
                    <td class="text-end border-end-0 border-bottom-0 border-top-0"></td>
                    <td class="text-end border-start-0 border-end-0 border-bottom-0 border-top-0"></td>
                    <td class="text-end border-end-0 border-bottom-0 border-top-0"></td>
                    <td class="text-end border-start-0 border-bottom-0 border-top-0"></td>
                </tr>

            <?php else : ?>

                <tr class="text-nowrap" data-key="<?= $model->fakturDetails[0]->id ?>">
                    <td class="text-end border-bottom-0 border-top-0 border-end-0"
                        style="width:50px; min-width:1% !important"><?= $i + 1 ?></td>
                    <td class="border-bottom-0 border-top-0 border-end-0 "
                        style="white-space: nowrap; width: 12rem; min-width: 12rem;"><?= $model->fakturDetails[$i]->barang->part_number ?></td>
                    <td class="text-nowrap border-bottom-0 border-top-0 border-end-0 "><?= $model->fakturDetails[$i]->barang->nama ?></td>
                    <td class="text-end text-nowrap border-bottom-0 border-top-0 border-end-0 "><?= $model->fakturDetails[$i]->quantity ?> <?= $model->fakturDetails[$i]->satuan->nama ?> </td>
                    <td class="text-end border-end-0 border-bottom-0 border-top-0"><?= Yii::$app->getFormatter()->currencyCode ?></td>
                    <td class="text-end border-start-0 border-end-0 border-bottom-0 border-top-0"><?= Yii::$app->formatter->asDecimal($model->fakturDetails[$i]->harga_barang, 2) ?></td>
                    <td class="text-end border-end-0 border-bottom-0 border-top-0"><?= Yii::$app->getFormatter()->currencyCode ?></td>
                    <td class="text-end border-start-0 border-bottom-0 border-top-0"><?= Yii::$app->formatter->asDecimal($model->fakturDetails[$i]->subTotal, 2) ?></td>
                </tr>
            <?php endif ?>
        <?php endfor ?>
        </tbody>
        <tbody class="kv-page-summary-container">
            <tr class="table-warning kv-page-summary w0">
            <td class="kv-align-center kv-align-middle" style="width:50px;">&nbsp;</td>
            <td colspan="5">
                <?= Html::tag('span', 'Terbilang: ' . Yii::$app->formatter->asSpellout($sumSubtotal)); ?>
            </td>
            <td class="text-end border-end-0 ">
                <?= Yii::$app->getFormatter()->currencyCode; ?>
            </td>
            <td class="text-end border-start-0">
                <?php
                echo Yii::$app->formatter->asDecimal(array_sum(ArrayHelper::getColumn($model->fakturDetails, 'subTotal')), 2);
                ?>
            </td>
        </tr>
        </tbody>
    </table>
    <?php if (!$openWindowPrint) echo Html::endTag('div') ?>


    <div class="mt-1" style="width: 100%">
        <div style="float:left; width: 20%">Tanda Terima</div>
        <div style="float:left; width: 45%">
            <?php if ($model->tokoSaya->kode == 'STM'): ?>

                <?php if($model->rekening_id) : ?>
                Pembayaran Melalui Bank
                <table>
                    <?php foreach($model->rekening->rekeningDetails as $rekeningDetail) : ?>
                        <tr>
                            <th class="text-start"><?= $rekeningDetail->bank ?></th>
                            <th>:</th>
                            <th class="text-start"><?= $rekeningDetail->nomor_rekening ?></th>
                        </tr>
                    <?php endforeach; ?>

                    <tr>
                        <th class="text-start">A/N</th>
                        <th>:</th>
                        <th class="text-start"><?= $model->rekening->atas_nama ?></th>
                    </tr>
                 
                </table>
                <?php endif ?>
            <?php endif ?>
        </div>
        <div style="float:right; width: 25%; text-align: right">
            Grand Total<br/>
            <b><?= Yii::$app->getFormatter()->currencyCode ?> <?= Yii::$app->formatter->asDecimal($sumSubtotal, 2) ?></b>
        </div>
        <div style="float:right; width: 10%">Hormat Kami</div>
    </div>
</div>