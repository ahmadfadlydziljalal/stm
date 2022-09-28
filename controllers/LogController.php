<?php

namespace app\controllers;

use app\models\Log;
use app\models\search\LogSearch;
use Yii;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class LogController extends Controller
{
    public function actionIndex(): string
    {

        $searchModel = new LogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing Cache model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $_id
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     * @throws StaleObjectException
     */
    public function actionDelete(string $_id): Response
    {
        $model = $this->findModel($_id);
        $model->delete();

        Yii::$app->session->setFlash('danger', 'Log: ' . $model->_id . ' berhasil dihapus.');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Cache model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $_id
     * @return Log the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(string $_id): Log
    {
        if (($model = Log::findOne($_id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}