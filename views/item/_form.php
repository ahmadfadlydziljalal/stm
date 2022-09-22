<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $modelsDetail app\models\ItemDetail */
/* @var $form yii\bootstrap5\ActiveForm */
?>

<div class="item-form">

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
                    <?= $form->field($model, 'name')->textInput([
                    'maxlength' => true,
                    'autofocus'=> 'autofocus'
                ]) ?>
            <?= $form->field($model, 'tanggal')->widget(\kartik\datecontrol\DateControl::class,[ 'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE, ]) ?>
            <?= $form->field($model, 'tanggal_waktu')->widget(\kartik\datecontrol\DateControl::class,[ 'type'=>\kartik\datecontrol\DateControl::FORMAT_DATETIME, ]) ?>
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
                'formFields' => [ 'id',  'item_id',  'name',  'dropdown_item', ],
                ]);
            ?>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="4">Item detail</th>
                    </tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Dropdown item</th>
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

                        <td><?= $form->field($modelDetail, "[$i]name", ['template' =>
                            '{input}{error}{hint}', 'options' =>['class' => null] ]); ?></td>
                        <td><?= $form->field($modelDetail, "[$i]dropdown_item", ['template' =>
                            '{input}{error}{hint}', 'options' =>['class' => null] ]); ?></td>
                        
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
                        <td class="text-end" colspan="3">
                            <?php echo Html::button('<span class="bi bi-plus-circle"></span> Tambah', [ 'class' => 'add-item btn btn-success', ]); ?>
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
            <?= Html::submitButton(' Simpan', ['class' =>'btn btn-success'])?>
        </div>
    </div>

    <?php ActiveForm::end();  ?> 

</div>