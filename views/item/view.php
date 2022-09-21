<?php
use yii\bootstrap5\Tabs;
use yii\widgets\DetailView;
use app\widgets\Table;
use yii\helpers\Html;
use mdm\admin\components\Helper;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-view">

    <div class="d-flex justify-content-between flex-wrap mb-3 mb-md-3 mb-lg-0" style="gap: .5rem">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="d-flex flex-row flex-wrap align-items-center" style="gap: .5rem">
            <?= Html::a('Index', ['index'], ['class' => 'btn btn-outline-primary']) ?>
            <?= Html::a('Buat Lagi', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Kembali', Yii::$app->request->referrer, ['class' => 'btn btn-outline-secondary']) ?>
            <?= Html::a('Update',['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) ?>
            <?php 
                if(Helper::checkRoute('delete')) :
                    echo Html::a('Hapus', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-outline-danger',
                        'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]);
                endif;
            ?>
        </div>
    </div>


                
    <?php try { 
            echo DetailView::widget([
                'model' => $model,
                'options' => [
                    'class' => 'table table-bordered'
                ],
                'attributes' => [
                    'name',
'tanggal:date',
'tanggal_waktu:datetime',
                ],
            ]);

            echo Html::tag('h2','Item Detail');
            echo !empty( $model->itemDetails) ?
                GridView::widget([
                    'dataProvider' => new ArrayDataProvider([
                        'allModels' => $model->itemDetails
                    ]),
                    'columns' => [
                           [
                               'class' => 'yii\grid\SerialColumn',
                           ],
                          // [
                             // 'class'=>'\yii\grid\DataColumn',
                             // 'attribute'=>'id',
                          // ],
                          // [
                             // 'class'=>'\yii\grid\DataColumn',
                             // 'attribute'=>'item_id',
                          // ],
                          [
                             'class'=>'\yii\grid\DataColumn',
                             'attribute'=>'name',
                          ],
                          [
                             'class'=>'\yii\grid\DataColumn',
                             'attribute'=>'dropdown_item',
                          ],
                          [
                             'label' => 'Item Detail Detail',
                             'format' => 'raw',
                             'value' => function($model){
                                   return GridView::widget([
                                        'dataProvider' => new ArrayDataProvider([
                                             'allModels' => $model->itemDetailDetails
                                        ]),
                                        'columns' =>[
                                             [
                                                  'class' => 'yii\grid\SerialColumn',
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
                                 }
                             ]
                         ]
                     ]) :
                     Html::tag("p", 'Item Detail tidak tersedia', [
                         'class' => 'text-warning font-weight-bold p-3'
                     ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    ?>

</div>