<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $i int|string */
/* @var $model app\models\Item */
/* @var $modelsDetail app\models\ItemDetail */
/* @var $modelsDetailDetail app\models\ItemDetailDetail */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner',
    'widgetBody' => '.container-rooms',
    'widgetItem' => '.room-item',
    'limit' => 10,
    'min' => 1,
    'insertButton' => '.add-room',
    'deleteButton' => '.remove-room',
    'model' => $modelsDetailDetail[0],
    'formId' => 'dynamic-form',
    'formFields' => [ 'id',  'item_detail_id',  'name',  'dropdown_item', ],
]); ?>

<table class="table table-bordered">

    <thead class="thead-light">
        <tr>
            <th colspan="4">Item detail detail</th>
        </tr>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Dropdown item</th>
            <th scope="col" style="width: 2px">Aksi</th>
        </tr>
    </thead>
    <tbody class="container-rooms">
    <?php foreach ($modelsDetailDetail as $j => $modelDetailDetail): ?>
    <tr class="room-item">
        <td style="width: 2px;">

            <?php if (!$modelDetailDetail->isNewRecord) {
            echo Html::activeHiddenInput($modelDetailDetail, "[{$i}][{$j}]id");
            }  ?>

            <i class="bi bi-chevron-double-right"></i>
        </td>

        <td><?= $form->field($modelDetailDetail, "[{$i}][{$j}]name", ['template' => '{input}{error}{hint}', 'options' =>['class' => null] ]); ?></td>
        <td><?= $form->field($modelDetailDetail, "[{$i}][{$j}]dropdown_item", ['template' => '{input}{error}{hint}', 'options' =>['class' => null] ]); ?></td>
        
        <td class="text-center" style="width: 90px;">
            <button type="button" class="remove-room btn btn-link text-danger">
                <i class="bi bi-trash"> </i>
            </button>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>

    <tfoot>
    <tr>
        <td colspan="4" style="text-align: end">
            <?php echo Html::button('<span class="fa fa-plus"></span> Tambah item Detail Details' , [
                'class' => 'add-room btn btn-success',
            ]); ?>
        </td>
    </tr>
    </tfoot>

</table>
<?php  DynamicFormWidget::end(); ?>