<?php
use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $i int|string */
/* @var $model app\models\Item */
/* @var $modelsDetail app\models\ItemDetail */
/* @var $modelsDetailDetail app\models\ItemDetailDetail */
/* @var $form yii\bootstrap5\ActiveForm */
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
            <th scope="col" class="text-center" style="width: 2px"><?php echo Html::button('<span class="bi bi-plus-circle"></span>' , [ 'class' => 'add-room btn btn-link text-primary', ]); ?></th>
        </tr>
    </thead>
    <tbody class="container-rooms">
    <?php foreach ($modelsDetailDetail as $j => $modelDetailDetail): ?>
    <tr class="room-item">
        <td class="align-middle"  style="width: 2px;">

            <?php if (!$modelDetailDetail->isNewRecord) {
            echo Html::activeHiddenInput($modelDetailDetail, "[$i][$j]id");
            }  ?>

            <i class="bi bi-dash"></i>
        </td>

        <td><?= $form->field($modelDetailDetail, "[$i][$j]name", ['template' => '{input}{error}{hint}', 'options' =>['class' => null] ]); ?></td>
        <td><?= $form->field($modelDetailDetail, "[$i][$j]dropdown_item", ['template' => '{input}{error}{hint}', 'options' =>['class' => null] ]); ?></td>
        
        <td class="text-center" style="width: 90px;">
            <button type="button" class="remove-room btn btn-link text-danger">
                <i class="bi bi-trash"> </i>
            </button>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>

</table>
<?php  DynamicFormWidget::end(); ?>