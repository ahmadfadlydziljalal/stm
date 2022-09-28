<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @see app\controllers\LogController::actionIndex() */

$this->title = 'Log';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="Log-index">

    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="my-0"><?= Html::encode($this->title) ?></h1>
        <div class="ms-md-auto ms-lg-auto">
            <?= Html::a('<i class="bi bi-arrow-clockwise"></i>' . ' Reload', ['index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>


    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php try {

        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => function ($model, $index, $key) {
                return $this->render('_item', [
                    'model' => $model,
                    'index' => $index,
                    'key' => $key
                ]);
            },
            'itemOptions' => [
                'class' => "",
            ],
            'options' => [
                'tag' => 'div',
                'class' => 'd-flex flex-column gap-3',
            ],
            'pager' => [
                'firstPageLabel' => 'First',
                'lastPageLabel' => 'Last',
                'prevPageLabel' => '<i class="bi bi-chevron-left small"></i>',
                'nextPageLabel' => '<i class="bi bi-chevron-right small"></i>',
                'maxButtonCount' => 3,
            ],
        ]);
    } catch (Exception $e) {
        echo $e->getMessage();
    } catch (Throwable $e) {
        echo $e->getMessage();
    }
    ?>

</div>