<?php


/* @var $this View */

/* @var $model Item */

use app\models\Item;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\DetailView;
use yii\widgets\ListView;

?>

<?php
try {
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'tanggal:date',
            'tanggal_waktu:datetime',
        ],
    ]);

    echo ListView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query' => $model->getItemDetails()
        ]),
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_view_detail', [
                'model' => $model,
                'index' => $index
            ]);
        },
        'layout' => '{items}'
    ]);
} catch (Exception $e) {
    echo $e->getMessage();
} catch (Throwable $e) {
    echo $e->getMessage();
}


?>