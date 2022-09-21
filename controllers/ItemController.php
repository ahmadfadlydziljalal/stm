<?php

namespace app\controllers;

use Yii;
use app\models\Item;

use app\models\search\ItemSearch;

use app\models\ItemDetail;

use app\models\ItemDetailDetail;

use app\models\Tabular;

use Throwable;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
}


    /**
     * Displays a single Item model.
     * @param integer $id
     * @return mixed
     * @throws HttpException
     */
    public function actionView($id){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Item model.
     * @return mixed
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Item();
        $modelsDetail = [ new ItemDetail() ];
        $modelsDetailDetail =[[new ItemDetailDetail()]];

        if($model->load($request->post())){

            $modelsDetail = Tabular::createMultiple(ItemDetail::class);
            Tabular::loadMultiple($modelsDetail, $request->post());

            //validate models
            $isValid = $model->validate();
            $isValid = Tabular::validateMultiple($modelsDetail) && $isValid;

            if (isset($_POST['ItemDetailDetail'][0][0])) {
                foreach ($_POST['ItemDetailDetail'] as $i => $itemDetailDetails) {
                    foreach ($itemDetailDetails as $j => $itemDetailDetail) {
                        $data['ItemDetailDetail'] = $itemDetailDetail;
                        $modelItemDetailDetail = new ItemDetailDetail();
                        $modelItemDetailDetail->load($data);
                        $modelsDetailDetail[$i][$j] = $modelItemDetailDetail;
                        $isValid = $modelItemDetailDetail->validate() && $isValid;
                    }
                }
            }

            if($isValid){

                $transaction = Item::getDb()->beginTransaction();

                try{
                    $status = [];
                    if ($flag = $model->save(false)) {
                        foreach ($modelsDetail as $i => $detail) :

                            if ($flag === false) {
                                break;
                            }

                            $detail->item_id = $model->id;
                            if (!($flag = $detail->save(false))) {
                                break;
                            }

                            if (isset($modelsDetailDetail[$i]) && is_array($modelsDetailDetail[$i])) {
                                foreach ($modelsDetailDetail[$i] as $j => $modelDetailDetail) {
                                    $modelDetailDetail->item_detail_id = $detail->id;
                                    if (!($flag = $modelDetailDetail->save(false))) {
                                        break;
                                    }
                                }
                            }

                        endforeach;
                    }

                    if ($flag) {
                        $transaction->commit();
                        $status = [
                            'code' => 1,
                            'message' => 'Commit'
                        ];
                    } else {
                        $transaction->rollBack();
                        $status = [
                            'code' => 0,
                            'message' => 'Roll Back'
                        ];
                    }
                }catch (\Exception $e){
                    $transaction->rollBack();
                    $status = [
                        'code' => 0,
                        'message' => 'Roll Back ' . $e->getMessage(),
                    ];
                }

                if($status['code']){
                    Yii::$app->session->setFlash('success',
                       "
                        Item : " . $model->name . " berhasil ditambahkan. ". Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], [ 'class' => 'btn btn-link'])
                    );
                    return $this->redirect(['index']);
                }

                Yii::$app->session->setFlash('danger',  " Item is failed to insert. Info: ". $status['message']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsDetail' => empty($modelsDetail) ? [ new ItemDetail() ] : $modelsDetail,
            'modelsDetailDetail' => empty($modelsDetailDetail) ? [[new ItemDetailDetail()]] : $modelsDetailDetail,
        ]);
    }

    /**
     * Updates an existing Item model.
     * Only for ajax request will return json object
     * @param integer $id
     * @param null $page
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws InvalidConfigException
     */
    public function actionUpdate($id, $page = null){
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $modelsDetail = !empty($model->itemDetails) ?
            $model->itemDetails :
            [new ItemDetail()];

        $modelsDetailDetail =[];
        $oldDetailDetails = [];

        if (!empty($modelsDetail)) {

            foreach ($modelsDetail as $i => $modelDetail) {
                $itemDetailDetails = $modelDetail->itemDetailDetails;
                $modelsDetailDetail[$i] = $itemDetailDetails;
                $oldDetailDetails = ArrayHelper::merge(ArrayHelper::index($itemDetailDetails, 'id'), $oldDetailDetails);
            }
        }

        if($model->load($request->post())){

            // reset
            $modelsDetailDetail = [];

            // GET OLD IDs
            $oldDetailsID = ArrayHelper::map($modelsDetail, 'id', 'id');

            $modelsDetail=Tabular::createMultiple(ItemDetail::class, $modelsDetail);
            Tabular::loadMultiple($modelsDetail, $request->post());

            $deletedDetailsID = array_diff($oldDetailsID,array_filter(
                    ArrayHelper::map($modelsDetail, 'id', 'id')
                )
            );

            //validate models
            $isValid = $model->validate();
            $isValid = Tabular::validateMultiple($modelsDetail) && $isValid;


            $detailDetailIDs = [];
            if (isset($_POST['ItemDetailDetail'][0][0])) {
                foreach ($_POST['ItemDetailDetail'] as $i => $itemDetailDetails) {

                    $detailDetailIDs = ArrayHelper::merge($detailDetailIDs, array_filter(ArrayHelper::getColumn($itemDetailDetails, 'id')));

                    foreach ($itemDetailDetails as $j => $itemDetailDetail) {
                        $data['ItemDetailDetail'] = $itemDetailDetail;

                        // Difference with actionCreate Here
                        $modelItemDetailDetail =
                            (isset($itemDetailDetail['id']) && isset($oldDetailDetails[$itemDetailDetail['id']]))
                            ? $oldDetailDetails[$itemDetailDetail['id']]
                            : new ItemDetailDetail();

                        $modelItemDetailDetail->load($data);
                        $modelsDetailDetail[$i][$j] = $modelItemDetailDetail;
                        $isValid = $modelItemDetailDetail->validate() && $isValid;
                    }
                }
            }


            $oldDetailDetailsIDs = ArrayHelper::getColumn($oldDetailDetails, 'id');
            $deletedDetailDetailsIDs = array_diff($oldDetailDetailsIDs, $detailDetailIDs);

            if($isValid){

                $transaction = Item::getDb()->beginTransaction();

                try{

                    if ($flag = $model->save(false)) {

                        if (!empty($deletedDetailDetailsIDs)) {
                            ItemDetailDetail::deleteAll(['id' => $deletedDetailDetailsIDs]);
                        }

                        if (!empty($deletedDetailsID)) {
                            ItemDetail::deleteAll(['id' => $deletedDetailsID]);
                        }



                        foreach ($modelsDetail as $i => $detail) :

                            if ($flag === false) {
                                break;
                            }

                            $detail->item_id = $model->id;
                            if (!($flag = $detail->save(false))) {
                                break;
                            }

                            if (isset($modelsDetailDetail[$i]) && is_array($modelsDetailDetail[$i])) {
                                foreach ($modelsDetailDetail[$i] as $j => $modelDetailDetail) {
                                    $modelDetailDetail->item_detail_id = $detail->id;
                                    if (!($flag = $modelDetailDetail->save(false))) {
                                        break;
                                    }
                                }
                            }

                        endforeach;
                    }

                    if ($flag) {
                        $transaction->commit();
                        $status = [
                            'code' => 1,
                            'message' => 'Commit'
                        ];
                    } else {
                        $transaction->rollBack();
                        $status = [
                            'code' => 0,
                            'message' => 'Roll Back'
                        ];
                    }
                }catch (\Exception $e){
                    $transaction->rollBack();
                    $status = [
                        'code' => 0,
                        'message' => 'Roll Back ' . $e->getMessage(),
                    ];
                }

                if($status['code']){
                    Yii::$app->session->setFlash('success',
                        "
                        Item : " . $model->name . " berhasil di update. ". Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id, 'page' => $page], [ 'class' => 'btn btn-link'])
                    );
                    return $this->redirect(['index']);
                }

                Yii::$app->session->setFlash('danger', " Item is failed to insert. Info: ". $status['message']);
            }else{
                return $this->render('update', [
                    'model' => $model,
                    'modelsDetail' => $modelsDetail,
                    'modelsDetailDetail' => $modelsDetailDetail,
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsDetail' => $modelsDetail,
            'modelsDetailDetail' => $modelsDetailDetail,
        ]);
    }

    /**
     * Delete an existing Item model.
     * Only for ajax request will return json object
     * @param integer $id
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id, $page = null){
        $model = $this->findModel($id);
        $oldLabel =  $model->name;

        $model->delete();

        Yii::$app->session->setFlash('danger', " Item : " . $oldLabel. " successfully deleted.");
        return $this->redirect(['index', 'page' => $page]);
    }


    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}