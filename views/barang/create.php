<?php
/* @var $this yii\web\View */
/* @var $model app\models\Barang */
/* @see app\controllers\BarangController::actionCreate() */

use yii\helpers\Html;
$this->title = 'Tambah Barang';
$this->params['breadcrumbs'][] = ['label' => 'Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="barang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>