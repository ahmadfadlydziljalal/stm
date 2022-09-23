<?php

namespace app\controllers;

use app\models\Item;
use app\models\ItemDetail;
use app\models\ItemDetailDetail;
use app\models\search\ItemSearch;
use app\models\Tabular;
use kartik\mpdf\Pdf;
use Mpdf\MpdfException;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use Throwable;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors(): array
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
     * @return string
     */
    public function actionIndex(): string
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
     * @return string
     * @throws HttpException
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Item
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Item model.
     * @return Response | string
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Item();
        $modelsDetail = [new ItemDetail()];
        $modelsDetailDetail = [[new ItemDetailDetail()]];

        if ($model->load($request->post())) {

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

            if ($isValid) {

                $transaction = Item::getDb()->beginTransaction();

                try {

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
                                foreach ($modelsDetailDetail[$i] as $modelDetailDetail) {
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
                } catch (Exception $e) {
                    $transaction->rollBack();
                    $status = [
                        'code' => 0,
                        'message' => 'Roll Back ' . $e->getMessage(),
                    ];
                }

                if ($status['code']) {
                    Yii::$app->session->setFlash('success', 'Item: ' . Html::a($model->name, ['view', 'id' => $model->id]) . " berhasil ditambahkan.");
                    return $this->redirect(['index']);
                }

                Yii::$app->session->setFlash('danger', " Item is failed to insert. Info: " . $status['message']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsDetail' => empty($modelsDetail) ? [new ItemDetail()] : $modelsDetail,
            'modelsDetailDetail' => empty($modelsDetailDetail) ? [[new ItemDetailDetail()]] : $modelsDetailDetail,
        ]);
    }

    /**
     * Updates an existing Item model.
     * Only for ajax request will return json object
     * @param integer $id
     * @return Response | string
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws InvalidConfigException
     */
    public function actionUpdate(int $id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $modelsDetail = !empty($model->itemDetails) ? $model->itemDetails : [new ItemDetail()];

        $modelsDetailDetail = [];
        $oldDetailDetails = [];

        if (!empty($modelsDetail)) {

            foreach ($modelsDetail as $i => $modelDetail) {
                $itemDetailDetails = $modelDetail->itemDetailDetails;
                $modelsDetailDetail[$i] = $itemDetailDetails;
                $oldDetailDetails = ArrayHelper::merge(ArrayHelper::index($itemDetailDetails, 'id'), $oldDetailDetails);
            }
        }

        if ($model->load($request->post())) {

            // reset
            $modelsDetailDetail = [];

            // GET OLD IDs
            $oldDetailsID = ArrayHelper::map($modelsDetail, 'id', 'id');

            $modelsDetail = Tabular::createMultiple(ItemDetail::class, $modelsDetail);
            Tabular::loadMultiple($modelsDetail, $request->post());

            $deletedDetailsID = array_diff($oldDetailsID, array_filter(
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

            if ($isValid) {

                $transaction = Item::getDb()->beginTransaction();

                try {

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
                                foreach ($modelsDetailDetail[$i] as $modelDetailDetail) {
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
                } catch (Exception $e) {
                    $transaction->rollBack();
                    $status = [
                        'code' => 0,
                        'message' => 'Roll Back ' . $e->getMessage(),
                    ];
                }

                if ($status['code']) {
                    Yii::$app->session->setFlash('info', "Item: " . Html::a($model->name, ['view', 'id' => $model->id]) . " berhasil di update.");
                    return $this->redirect(['index']);
                }

                Yii::$app->session->setFlash('danger', " Item is failed to insert. Info: " . $status['message']);
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
     * @return Response
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete(int $id): Response
    {
        $model = $this->findModel($id);
        $model->delete();

        Yii::$app->session->setFlash('danger', 'Item: ' . $model->name . ' berhasil dihapus.');
        return $this->redirect(['index']);
    }

    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     * @throws MpdfException
     * @throws CrossReferenceException
     * @throws PdfParserException
     * @throws PdfTypeException
     * @throws InvalidConfigException
     */
    public function actionExportPdf(int $id): string
    {
        /** @var Pdf $pdf */
        $pdf = Yii::$app->pdf;


//        return $this->renderPartial('_pdf', [
//            'model' => $this->findModel($id)
//        ]);
        
        $pdf->content = $this->renderPartial('_pdf', [
            'model' => $this->findModel($id)
        ]);
        return $pdf->render();
    }

}