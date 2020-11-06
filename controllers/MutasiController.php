<?php

namespace app\controllers;

use Yii;
use app\models\AtkHeaderDistribusi;
use app\models\AtkHeaderDistribusiSearch;
use app\models\AtkDetailDistribusi;
use app\models\AtkSatker;
use app\models\FileBarangAtk;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * MutasiController implements the CRUD actions for AtkHeaderDistribusi model.
 */
class MutasiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AtkHeaderDistribusi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AtkHeaderDistribusiSearch();
        $searchModel->tgl_distribusi = date('Y-m-d');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AtkHeaderDistribusi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AtkHeaderDistribusi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AtkHeaderDistribusi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_header_distribusi]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AtkHeaderDistribusi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = AtkHeaderDistribusi::findOne($id);
        $modelDetail = new AtkDetailDistribusi;

        $model->lokasi_asal = '16';
        $model->tgl_distribusi = date('Y-m-d');

        //use app\models\Country;
        $lokasi=AtkSatker::find()->orderBy('nama_satker ASC')->all();

        //use yii\helpers\ArrayHelper;
        $listLokasi=ArrayHelper::map($lokasi,'id_satker','nama_satker');

        $data = FileBarangAtk::find()
        ->select(['nama_barang as value', 'nama_barang as  label','kode_barang as id','satuan as sat','ROUND(harga_beli,0) as harga'])
        ->where(['aktif'=>1])
        ->asArray()
        ->all();

        return $this->render('/pembelian/mutasi', [
            'model' => $model,
            'modelDetail'=>$modelDetail,
            'listLokasi'=>$listLokasi,
            'data'=>$data
        ]);
    }

    /**
     * Deletes an existing AtkHeaderDistribusi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AtkHeaderDistribusi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AtkHeaderDistribusi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AtkHeaderDistribusi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
