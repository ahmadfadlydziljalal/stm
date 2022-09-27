<?php

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $index int */

use yii\data\ActiveDataProvider;
use kartik\grid\GridView;
use yii\helpers\StringHelper;
use yii\widgets\DetailView;
?>

<div class="card mb-4 border-1 item">

    <div class="card-body">
        <strong>
            <?= ($index + 1) . '. ' . StringHelper::basename(get_class($model)) ?>
        </strong>
    </div>
        

    <?php try { 
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                         // 'id',
                         // 'item_id',
                        'name',
                        'dropdown_item',
            ],
        ]);

        echo GridView::widget([
            'panel' => false,
            'bordered' => false,
            'striped' => false,
            'headerContainer' => [],
            'dataProvider' => new ActiveDataProvider([
                 'query' => $model->getItemDetailDetails(),
                 'sort' => false,
                 'pagination' => false
            ]),
            'tableOptions' => [
                'class' => 'mb-0'
            ],
            'layout' => '{items}',
            'columns' =>[
                 [
                    'class' => 'yii\grid\SerialColumn',
                    'contentOptions' => [
                        'style' => [
                            'width' => '2px'
                        ]
                    ],
                ],
                     // [
                          // 'class'=>'\yii\grid\DataColumn',
                          // 'attribute'=>'id',
                     // ],
                     // [
                          // 'class'=>'\yii\grid\DataColumn',
                          // 'attribute'=>'item_detail_id',
                     // ],
                     [
                          'class'=>'\yii\grid\DataColumn',
                          'attribute'=>'name',
                     ],
                     [
                          'class'=>'\yii\grid\DataColumn',
                          'attribute'=>'dropdown_item',
                     ],
           ]
       ]);
    } catch (Exception $e) {
        echo $e->getMessage();
    } catch (Throwable $e) {
        echo $e->getMessage();
    }
    ?>


</div>