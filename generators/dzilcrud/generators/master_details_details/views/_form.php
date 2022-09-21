<?php

use rmrevin\yii\fontawesome\FAS;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator \app\generators\dzilcrud\generators\Generator */

/* @var $model ActiveRecord */
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
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $modelsDetail <?= ltrim($generator->modelsClassDetail, '\\') ?> */
/* @var $modelsDetailDetail <?= ltrim($generator->modelsClassDetailDetail, '\\') ?> */
/* @var $form yii\bootstrap5\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?= "<?php " ?>$form = ActiveForm::begin([
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
            <?php foreach ($generator->getColumnNames() as $key => $attribute) {

                if (in_array($attribute, ['created_at', 'updated_at', 'created_by', 'updated_by'])) {
                    continue;
                }

                if (in_array($attribute, $safeAttributes)) {
                    if ($key == 1) {
                        echo "    <?= " . $generator->generateActiveFieldAutoFocus($attribute) . " ?>\n";
                    } else {
                        echo "<?php echo " . $generator->generateActiveField($attribute) . "; ?>\n\t";
                    }

                }
            } ?>
        </div>

        <div class="form-detail">
            <?= "<?php " ?>DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper',
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 100, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsDetail[0],
                'formId' => 'dynamic-form',
                'formFields' => [<?php foreach ($generator->getDetailColumnNames() as $columnName) {
                    echo " '" . $columnName . "', ";
                } ?>],
            ]); ?>

            <?php $detail = ucwords(Inflector::titleize(Inflector::pluralize(StringHelper::basename($generator->modelsClassDetail)))) ?>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?= $detail ?></th>
                        <th scope="col" style="width: 2px">Aksi</th>
                    </tr>
                    </thead>

                    <tbody class="container-items">

                    <?= "<?php " ?>foreach ($modelsDetail as $i => $modelDetail): ?>
                    <tr class="item">
                        <td style="width: 2px;">

                            <?= "<?php " ?>if (!$modelDetail->isNewRecord) {
                            echo Html::activeHiddenInput($modelDetail, "[{$i}]id");
                            } ?>
                            <i class="bi bi-arrow-right-short"></i>

                        </td>

                        <td>
                            <?php foreach ($generator->getDetailColumnNames() as $columnName) {
                                if ($columnName === 'id') continue;
                                if ($columnName === Inflector::underscore(StringHelper::basename($generator->modelClass)) . '_id') continue;
                                ?><?= "<?= " ?>$form->field($modelDetail, "[{$i}]<?= $columnName ?>", ['options' =>['class' => 'mb-3 row'] ]); ?>
                            <?php } ?>

                            <?= "<?= " ?>$this->render('_form-detail-detail', [
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

                    <?= "<?php " ?>endforeach; ?>
                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="3">
                            <?= "<?php echo " ?>Html::button('<span class="fa fa-plus"></span>
                            Tambah <?= lcfirst($detail) ?>', [
                            'class' => 'add-item btn btn-success',
                            ]); ?>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <?= "<?php DynamicFormWidget::end(); ?> \n" ?>
        </div>

        <div class="d-flex justify-content-between">
            <?= "<?= " ?>Html::submitButton(<?= $generator->generateString(' Simpan') ?>, ['class' =>'btn btn-primary' ]) ?>
            <?= "<?= " ?>Html::a( <?= $generator->generateString(' Tutup') ?>, ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>

    <?= "<?php ActiveForm::end();  ?> " ?>

</div>