<?php

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator \app\generators\dzilajaxcrud\generators\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $i int|string */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $modelsDetail <?= ltrim($generator->modelsClassDetail, '\\') ?> */
/* @var $modelsDetailDetail <?= ltrim($generator->modelsClassDetailDetail, '\\') ?> */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<?= "<?php " ?>
DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner',
    'widgetBody' => '.container-rooms',
    'widgetItem' => '.room-item',
    'limit' => 10,
    'min' => 1,
    'insertButton' => '.add-room',
    'deleteButton' => '.remove-room',
    'model' => $modelsDetailDetail[0],
    'formId' => 'dynamic-form',
    'formFields' => [<?php foreach ($generator->getDetailDetailColumnNames() as $columnName) {
                echo " '" . $columnName . "', " ;} ?>],
]); ?>

<?php $detailDetail =   ucwords(Inflector::titleize(Inflector::pluralize(StringHelper::basename($generator->modelsClassDetailDetail)))) ?>
<table class="table table-bordered">

    <thead class="thead-light">
        <tr>
            <?php
            $colspan = 0;
            foreach ($generator->getDetailDetailColumnNames() as $columnName) {
                if ($columnName === 'id') continue;
                if ($columnName === Inflector::underscore(StringHelper::basename($generator->modelsClassDetail)) . '_id') continue;
                $colspan += 1;
                ?><?php } ?><th colspan="<?=  $colspan + 2 ?>"><?= Inflector::titleize(StringHelper::basename($generator->modelsClassDetailDetail)) ?></th>
        </tr>
        <tr>
            <th scope="col">#</th>
            <?php foreach ($generator->getDetailDetailColumnNames() as $columnName) {
                if ($columnName === 'id') continue;
                if ($columnName === Inflector::underscore(StringHelper::basename($generator->modelsClassDetail)) . '_id') continue;
                ?><th scope="col"><?= Inflector::humanize($columnName) ?></th>
            <?php } ?><th scope="col" style="width: 2px">Aksi</th>
        </tr>
    </thead>
    <tbody class="container-rooms">
    <?= "<?php " ?>foreach ($modelsDetailDetail as $j => $modelDetailDetail): ?>
    <tr class="room-item">
        <td style="width: 2px;">

            <?= "<?php " ?>if (!$modelDetailDetail->isNewRecord) {
            echo Html::activeHiddenInput($modelDetailDetail, "[{$i}][{$j}]id");
            }  ?>

            <i class="bi bi-chevron-double-right"></i>
        </td>

        <?php foreach ($generator->getDetailDetailColumnNames() as $columnName) {
            if ($columnName === 'id') continue;
            if ($columnName === Inflector::underscore(StringHelper::basename($generator->modelsClassDetail)) . '_id') continue;
            ?><td><?="<?= " ?>$form->field($modelDetailDetail, "[{$i}][{$j}]<?= $columnName ?>", ['template' => '{input}{error}{hint}', 'options' =>['class' => null] ]); ?></td>
        <?php } ?>

        <td class="text-center" style="width: 90px;">
            <button type="button" class="remove-room btn btn-link text-danger">
                <i class="bi bi-trash"> </i>
            </button>
        </td>
    </tr>
    <?= "<?php " ?>endforeach; ?>
    </tbody>

    <tfoot>
    <tr>
        <td colspan="<?= $colspan + 2  ?>" style="text-align: end">
            <?= "<?php echo " ?>Html::button('<span class="fa fa-plus"></span> Tambah <?= lcfirst($detailDetail) ?>' , [
                'class' => 'add-room btn btn-success',
            ]); ?>
        </td>
    </tr>
    </tfoot>

</table>
<?= "<?php " ?> DynamicFormWidget::end(); ?>