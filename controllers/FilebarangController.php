<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\FileBarangAtk;
use app\models\TabelKelompok;
use app\models\AtkFileSupplier;
use app\models\FileBarangAtkSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * FilebarangController implements the CRUD actions for FileBarangAtk model.
 */
class FilebarangController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','update','delete'],
                'rules' => [
                    [
                        'actions' => ['index','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            /*'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],*/
        ];
    }

    /**
     * Lists all FileBarangAtk models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileBarangAtkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'=>$searchModel
        ]);
    }

    /**
     * Displays a single FileBarangAtk model.
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
     * Creates a new FileBarangAtk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FileBarangAtk();

        //use app\models\Country;
        $kategori=TabelKelompok::find()->all();

        //use yii\helpers\ArrayHelper;
        $listData=ArrayHelper::map($kategori,'KodeKelompok','KelompokBarang');

        $supplier = AtkFileSupplier::find()->all();

        $listSupplier = ArrayHelper::map($supplier,'KodeSupplier','NamaSupplier');

        if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'listData'=>$listData,
            'listSupplier'=>$listSupplier
        ]);
    }

    /**
     * Updates an existing FileBarangAtk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->harga_beli = round($model->harga_beli,0);

        //use app\models\Country;
        $kategori=TabelKelompok::find()->all();

        //use yii\helpers\ArrayHelper;
        $listData=ArrayHelper::map($kategori,'KodeKelompok','KelompokBarang');

        $supplier = AtkFileSupplier::find()->all();

        $listSupplier = ArrayHelper::map($supplier,'KodeSupplier','NamaSupplier');

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'listData'=>$listData,
            'listSupplier'=>$listSupplier
        ]);
    }

    /**
     * Deletes an existing FileBarangAtk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->aktif = 0;

        if($model->save(false)){
            return $this->redirect(['index']);
        }
        /*$this->findModel($id)->delete();

        return $this->redirect(['index']);*/
    }

    /**
     * Finds the FileBarangAtk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FileBarangAtk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FileBarangAtk::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
