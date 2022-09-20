<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Session */
/* @var $form yii\bootstrap5\ActiveForm */
?>

<div class="session-form">

    <?php $form = ActiveForm::begin([
    'layout' => ActiveForm::LAYOUT_FLOATING
    ]); ?>

        <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'expire')->textInput()?>
    <?= $form->field($model, 'data')->textInput() ?>
    <?= $form->field($model, 'user_id')->textInput() ?>
    <?= $form->field($model, 'last_write')->textInput() ?>

    <div class="d-flex mt-3 justify-content-between">
        <?= Html::submitButton(' Simpan', ['class' =>'btn btn-success' ]) ?>
        <?= Html::a(' Tutup', ['index'], [
        'class' => 'btn btn-secondary',
        'type' => 'button'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>