<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $modelsDetail app\models\ItemDetail */
/* @var $modelsDetailDetail app\models\ItemDetailDetail */
/* @var $form yii\bootstrap5\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
            'layout' => ActiveForm::LAYOUT_HORIZONTAL,
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-4',
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
                <?= $form->field($model, 'name')->textInput([
                    'maxlength' => true,
                    'autofocus'=> 'autofocus'
                ]) ?>
<?php echo $form->field($model, 'tanggal')->widget(\kartik\datecontrol\DateControl::class,[ 'type'=>kartik\datecontrol\DateControl::FORMAT_DATE, ]); ?>
	<?php echo $form->field($model, 'tanggal_waktu')->widget(\kartik\datecontrol\DateControl::class,[ 'type'=>kartik\datecontrol\DateControl::FORMAT_DATETIME, ]); ?>
	        </div>

        <div class="form-detail">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper',
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 100, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsDetail[0],
                'formId' => 'dynamic-form',
                'formFields' => [ 'id',  'item_id',  'name',  'dropdown_item', ],
            ]); ?>

            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item Details</th>
                        <th scope="col" style="width: 2px">Aksi</th>
                    </tr>
                    </thead>

                    <tbody class="container-items">

                    <?php foreach ($modelsDetail as $i => $modelDetail): ?>
                    <tr class="item">
                        <td style="width: 2px;">

                            <?php if (!$modelDetail->isNewRecord) {
                            echo Html::activeHiddenInput($modelDetail, "[{$i}]id");
                            } ?>
                            <i class="bi bi-arrow-right-short"></i>

                        </td>

                        <td>
                            <?= $form->field($modelDetail, "[{$i}]name", ['options' =>['class' => 'mb-3 row'] ]); ?>
                            <?= $form->field($modelDetail, "[{$i}]dropdown_item", ['options' =>['class' => 'mb-3 row'] ]); ?>
                            
                            <?= $this->render('_form-detail-detail', [
                                    'form' => $form,
                                    'i' => $i,
                                    'modelsDetailDetail' => $modelsDetailDetail[$i],
                            ]) ?>
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
                        <td colspan="3">
                            <?php echo Html::button('<span class="fa fa-plus"></span>
                            Tambah item Details', [
                            'class' => 'add-item btn btn-success',
                            ]); ?>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <?php DynamicFormWidget::end(); ?> 
        </div>

        <div class="d-flex justify-content-between">
            <?= Html::submitButton(' Simpan', ['class' =>'btn btn-primary' ]) ?>
            <?= Html::a( ' Tutup', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>

    <?php ActiveForm::end();  ?> 
</div>