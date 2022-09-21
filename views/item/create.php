<?php

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $modelsDetail app\models\ItemDetail */
/* @var $modelsDetailDetail app\models\ItemDetailDetail */

use yii\helpers\Html;
$this->title = 'Tambah Item';
$this->params['breadcrumbs'][] = ['label' => 'Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetail' => $modelsDetail,
        'modelsDetailDetail' => $modelsDetailDetail,
    ]) ?>

</div>