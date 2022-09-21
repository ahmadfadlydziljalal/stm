<?php

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

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\bootstrap5\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?= "<?php " ?>$form = ActiveForm::begin([

        'layout' => ActiveForm::LAYOUT_HORIZONTAL,
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-4 col-lg-3',
                'offset' => 'offset-sm-4 offset-lg-3',
                'wrapper' => 'col-sm-8 col-lg-9',
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

    <?php foreach ($generator->getColumnNames() as $key => $attribute) {
        if (in_array($attribute, ['created_at', 'updated_at', 'created_by', 'updated_by'])) {
            continue;
        }
        if (in_array($attribute, $safeAttributes)) {
            if ($key == 1) {
                echo "    <?= " . $generator->generateActiveFieldAutoFocus($attribute) . "?>\n";
            } else {
                echo "        <?= " . $generator->generateActiveField($attribute) . " ?>\n";
            }
        }
    } ?>

    <div class="d-flex mt-3 justify-content-between">
        <?= "<?= " ?>Html::submitButton(<?= $generator->generateString(' Simpan') ?>, ['class' =>'btn btn-success' ]) ?>
        <?= "<?= " ?>Html::a(<?= $generator->generateString(' Tutup') ?>, ['index'], [
            'class' => 'btn btn-secondary',
            'type' => 'button'
        ]) ?>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>