<?php
/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @see app\controllers\ItemController::actionCreate() */

use yii\helpers\Html;
$this->title = 'Tambah Item';
$this->params['breadcrumbs'][] = ['label' => 'Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>