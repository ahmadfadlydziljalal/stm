<?php
/**
 * @var $model Cache
 * @var $key int
 * @var $index string
 * */

use app\models\Cache;
use yii\helpers\Html;

?>


<div class="card border-primary">
    <div class="card-body">

        <p class="card-title">
            <strong><?= $index ?>.</strong>
            <?= Yii::$app->formatter->asDatetime($model->expire) ?>
        </p>

        <div class="d-flex flex-row my-3 gap-3">
            <?= Html::a(
                Html::tag('i', '', ['class' => 'bi bi-trash']) . ' Delete',
                ['cache/delete', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'method' => 'POST',
                        'confirm' => 'Anda akan menghapus cache ini ?'
                    ]
                ])
            ?>
        </div>

        <small class="card-text"><?= $model->data; ?></small>
    </div>
</div>