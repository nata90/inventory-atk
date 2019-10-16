<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\AtkDetailPembelian;
use app\models\AtkDetailDistribusiSearch;
use app\models\AtkRekapStokSearch;
use app\models\AtkFileSupplier;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii2tech\spreadsheet\Spreadsheet;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;
use app\components\Utility;

/**
 * LaporanController implements the CRUD actions for AtkDetailPembelian model.
 */
class LaporanController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','mutasi','view','create','update','delete','laporanrekap'],
                'rules' => [
                    [
                        'actions' => ['index','mutasi','view','create','update','delete','laporanrekap'],
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
     * Lists all AtkDetailPembelian models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AtkDetailDistribusiSearch();
        $searchModel->start_date = date('Y-m-d');
        $searchModel->end_date = date('Y-m-d');

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMutasi()
    {
        $searchModel = new AtkDetailDistribusiSearch();
        $searchModel->start_date = date('Y-m-d');
        $searchModel->end_date = date('Y-m-d');

        $dataProvider = $searchModel->searchMutasi(Yii::$app->request->queryParams);

        return $this->render('mutasi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AtkDetailPembelian model.
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
     * Creates a new AtkDetailPembelian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AtkDetailPembelian();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AtkDetailPembelian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AtkDetailPembelian model.
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


    public function actionLaporanrekap(){
        $searchModel = new AtkRekapStokSearch();
        $searchModel->tgl_rekap = date('Y-m-d');

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('rekap_stok', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExcelpembelian(){
        //$params = Yii::$app->session['params-pembelian'];
        $searchModel = new AtkDetailDistribusiSearch();

        if(isset(Yii::$app->session['start_date']) && isset(Yii::$app->session['end_date'])){
            $searchModel->start_date = date('Y-m-d', strtotime(Yii::$app->session['start_date']));
            $searchModel->end_date = date('Y-m-d', strtotime(Yii::$app->session['end_date']));
        }else{
            $searchModel->start_date = date('Y-m-d');
            $searchModel->end_date = date('Y-m-d');
        }
        
        
        $exporter = new Spreadsheet([
            'dataProvider' => $searchModel->search(Yii::$app->request->queryParams),
            'columns' => [
                [
                    'attribute'=>'no_pembelian',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->no_pembelian;
                    },
                ],
                [
                    'attribute'=>'tgl_pembelian',
                    'format'=>'raw',
                    'value'=>function($model){
                        return date('d-m-Y', strtotime($model->header->tanggal_pembelian));
                    }
                ],
                'kode_barang',
                [
                    'attribute'=>'nama_barang',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->barang->nama_barang;
                    }
                ],
                'satuan',
                [
                    'attribute'=>'jumlah',
                    'format'=>'raw',
                    'value'=>function($model){
                        return round($model->jumlah,0);
                    }
                ],
                [
                    'attribute'=>'harga',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->harga;
                    }
                ],
                [
                    'attribute'=>'total',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->harga*$model->jumlah;
                    }
                ],
            ],
        ]);

        $exporter->title = 'Laporan Pembelian';

        $exporter->headerColumnUnions = 
        [
            [
              'header' => 'LAPORAN PEMBELIAN '.date('d/m/Y', strtotime($searchModel->start_date)).' - '.date('d/m/Y', strtotime($searchModel->end_date)),
              'offset' => 0,
              'length' => 8,
            ]
        ];

        return $exporter->send('pembelian.xls');
    }

    public function actionExcelmutasi(){
        //$params = Yii::$app->session['params-pembelian'];
        $searchModel = new AtkDetailDistribusiSearch();

        if(isset(Yii::$app->session['start_date_mutasi']) && isset(Yii::$app->session['end_date_mutasi'])){
            $searchModel->start_date = date('Y-m-d', strtotime(Yii::$app->session['start_date_mutasi']));
            $searchModel->end_date = date('Y-m-d', strtotime(Yii::$app->session['end_date_mutasi']));
        }else{
            $searchModel->start_date = date('Y-m-d');
            $searchModel->end_date = date('Y-m-d');
        }
        
        
        $exporter = new Spreadsheet([
            'dataProvider' => $searchModel->searchMutasi(Yii::$app->request->queryParams),
            'columns' => [
                [
                    'attribute'=>'no_distribusi',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->header->no_distribusi;
                    },
                ],
                [
                    'attribute'=>'lokasi_asal',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->header->lokasiasal->nama_satker;
                    },
                ],
                [
                    'attribute'=>'lokasi_distribusi',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->header->distribusi->nama_satker;
                    },
                ],
                'kode_barang',
                [
                    'attribute'=>'nama_barang',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->barang->nama_barang;
                    }
                ],
                [
                    'attribute'=>'tgl_distribusi',
                    'format'=>'raw',
                    'value'=>function($model){
                        return date('d-m-Y', strtotime($model->header->tgl_distribusi));
                    }
                ],
                'jumlah_distribusi',
            ],
        ]);

        $exporter->title = 'Laporan Mutasi';

        $exporter->headerColumnUnions = 
        [
            [
              'header' => 'LAPORAN MUTASI '.date('d/m/Y', strtotime($searchModel->start_date)).' - '.date('d/m/Y', strtotime($searchModel->end_date)),
              'offset' => 0,
              'length' => 7,
            ]
        ];

        return $exporter->send('mutasi.xls');
    }

    public function actionExcelrekap(){
        //$params = Yii::$app->session['params-pembelian'];
        $searchModel = new AtkRekapStokSearch();

        if(isset(Yii::$app->session['tgl_rekap'])){
            $searchModel->tgl_rekap = date('Y-m-d', strtotime(Yii::$app->session['tgl_rekap']));
        }else{
            $searchModel->tgl_rekap = date('Y-m-d');
        }
        
        
        $exporter = new Spreadsheet([
            'dataProvider' => $searchModel->search(Yii::$app->request->queryParams),
            'columns' => [
                [
                    'attribute'=>'tgl_rekap',
                    'format'=>'raw',
                    'value'=>function($model){
                        return date('d-m-Y', strtotime($model->tgl_rekap));
                    },
                ],
                'kode_barang',
                [
                    'attribute'=>'nama_barang',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->barang->nama_barang;
                    },
                ],
                [
                    'attribute'=>'stok_awal',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->stok_awal;
                    },
                    'filter'=>false
                ],
                [
                    'attribute'=>'stok_masuk',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->stok_masuk;
                    },
                    'filter'=>false
                ],
                [
                    'attribute'=>'stok_keluar',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->stok_keluar;
                    },
                    'filter'=>false
                ],
                [
                    'attribute'=>'stok_akhir',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->stok_awal + $model->stok_masuk - $model->stok_keluar;
                    },
                    'filter'=>false
                ],
            ],
        ]);

        $exporter->title = 'Laporan Rekap';

        $exporter->headerColumnUnions = 
        [
            [
              'header' => 'LAPORAN REKAP '.date('d/m/Y', strtotime($searchModel->tgl_rekap)),
              'offset' => 0,
              'length' => 7,
            ]
        ];

        return $exporter->send('rekap.xls');
    }

    /**
     * Finds the AtkDetailPembelian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AtkDetailPembelian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AtkDetailPembelian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
