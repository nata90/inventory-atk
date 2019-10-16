<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\AtkHeaderPembelian;
use app\models\AtkDetailPembelian;
use app\models\SettingLokasiStok;
use app\models\SettingFormulir;
use app\models\TabelTermin;
use app\models\AtkFileSupplier;
use app\models\FileBarangAtk;
use app\models\AtkHeaderDistribusi;
use app\models\AtkDetailDistribusi;
use app\models\AtkSatker;
use app\models\AtkHeaderPembelianSearch;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\db\Transaction;


class PembelianController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','prosesmutasi','prosestransaksi','deleteitem','admin','delete','update','mutasi','deleteitemmutasi'],
                'rules' => [
                    [
                        'actions' => ['index','prosesmutasi','prosestransaksi','deleteitem','admin','delete','update','mutasi','deleteitemmutasi'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            /*'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],*/
        ];
    }

    public function actionIndex()
    {
    	

    	$model = new AtkHeaderPembelian();
    	$model->tanggal_pembelian = date('Y-m-d');
    	$model->tanggal_jatuh_tempo = date('Y-m-d');
    	$model->kode_lokasi = 'ATK';

    	$modelDetail = new AtkDetailPembelian();

    	//use app\models\Country;
        $lokasi=SettingLokasiStok::find()->where('GudangUtama = 1')->all();

        //use yii\helpers\ArrayHelper;
        $listData=ArrayHelper::map($lokasi,'KodeLokasi','LokasiStok');

        $termin=TabelTermin::find()->all();

        $listTermin = ArrayHelper::map($termin,'KodeTermin','Termin');

        $supplier=AtkFileSupplier::find()->orderBy('NamaSupplier ASC')->all();

        $listSupplier = ArrayHelper::map($supplier,'KodeSupplier','NamaSupplier');

        $data = FileBarangAtk::find()
        ->select(['nama_barang as value', 'nama_barang as  label','kode_barang as id','satuan as sat','ROUND(harga_beli,0) as harga'])
        ->where(['aktif'=>1])
        ->asArray()
        ->all();

        return $this->render('index',[
        	'model'=>$model,
        	'modelDetail'=>$modelDetail,
        	'listData'=>$listData,
        	'listTermin'=>$listTermin,
        	'listSupplier'=>$listSupplier,
        	'data'=>$data
        ]);
    }

    public function actionProsesmutasi(){

        if(isset($_POST['AtkHeaderDistribusi']['no_distribusi']) && $_POST['AtkHeaderDistribusi']['no_distribusi'] != ''){
            $model = AtkHeaderDistribusi::find()->where('no_distribusi = :nid',[':nid'=>$_POST['AtkHeaderDistribusi']['no_distribusi']])->one();

            $no_distribusi = $model->no_distribusi;
        }else{
            $model = new AtkHeaderDistribusi;
            $no_distribusi = AtkHeaderDistribusi::getNoTransaksiMutasi();
        }

        $modelDetail = new AtkDetailDistribusi;

        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();

        $return = array();

        $model->no_distribusi = $no_distribusi;
        $model->tgl_distribusi = $_POST['AtkHeaderDistribusi']['tgl_distribusi'];
        $model->lokasi_asal = $_POST['AtkHeaderDistribusi']['lokasi_asal'];
        $model->lokasi_distribusi = $_POST['AtkHeaderDistribusi']['lokasi_distribusi'];
        $model->no_referensi = $_POST['AtkHeaderDistribusi']['no_referensi'];
        $model->keterangan = $_POST['AtkHeaderDistribusi']['keterangan'];

        $error = '<ul>';
        if($model->save()){
            $modelDetail->id_header_distribusi = $model->id_header_distribusi;
           if($modelDetail->load(Yii::$app->request->post()) && $modelDetail->save()){
                $setting = SettingFormulir::find()->where('KodeLokasi = "MUT"')->one();
                if($setting){
                    $setting->NomerTerakhir = $setting->NomerTerakhir + 1;
                    $setting->save(false);
                }

                $return['notrans'] = $modelDetail->header->no_distribusi;
                $return['table'] = $this->renderPartial('table_detail_mutasi',[
                    'model'=>$model
                ]);
                $return['error'] = 0;
                $return['msg'] = '';

                $transaction->commit();
           }else{
                foreach($modelDetail->getErrors() as $val){
                    $error .= '<li>'.$val[0].'</li>';
                }

                $return['error'] = 1;
                $return['msg'] = $error;

                $transaction->rollBack();
           }
        }else{
            foreach($model->getErrors() as $val){
                $error .= '<li>'.$val[0].'</li>';
            }
            
            $return['error'] = 1;
            $return['msg'] = $error;
            $transaction->rollBack();
        }
        $error .= '</ul>';

        echo Json::encode($return);
    }

    public function actionProsestransaksi(){

        if(isset($_POST['AtkHeaderPembelian']['no_pembelian']) && $_POST['AtkHeaderPembelian']['no_pembelian'] != ''){
            $model = AtkHeaderPembelian::find()->where('no_pembelian = :nop',[':nop'=>$_POST['AtkHeaderPembelian']['no_pembelian']])->one();
            $no_transaksi = $model->no_pembelian;
        }else{
            $model = new AtkHeaderPembelian();
            $no_transaksi = AtkHeaderPembelian::getNoTransaksiPembelian();
        }
    	
        $modelDetail = new AtkDetailPembelian();

        

        $return = array();

        
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();

        $error = '<ul>';
        //$model->load(Yii::$app->request->post());
        $model->kode_termin = $_POST['AtkHeaderPembelian']['kode_termin'];
        $model->kode_lokasi = $_POST['AtkHeaderPembelian']['kode_lokasi'];
        $model->no_referensi = $_POST['AtkHeaderPembelian']['no_referensi'];
        $model->kode_supplier = $_POST['AtkHeaderPembelian']['kode_supplier'];
        $model->tanggal_pembelian = $_POST['AtkHeaderPembelian']['tanggal_pembelian'];
        $model->tanggal_jatuh_tempo = $_POST['AtkHeaderPembelian']['tanggal_jatuh_tempo'];
        $model->keterangan = $_POST['AtkHeaderPembelian']['keterangan'];
        $model->no_pembelian = $no_transaksi;

    	if($model->save()) {
            $modelDetail->no_pembelian = $model->no_pembelian;
            if($modelDetail->load(Yii::$app->request->post()) && $modelDetail->save()){

                $setting = SettingFormulir::find()->where('KodeLokasi = "ATK"')->one();
                if($setting){
                    $setting->NomerTerakhir = $setting->NomerTerakhir + 1;
                    $setting->save(false);
                }

                $return['notrans'] = $modelDetail->no_pembelian;
                $return['table'] = $this->renderPartial('table_detail',[
                    'model'=>$model
                ]);
                $return['error'] = 0;
                $return['msg'] = '';

                $transaction->commit();
            }else{
                foreach($modelDetail->getErrors() as $val){
                    $error .= '<li>'.$val[0].'</li>';
                }

                $return['error'] = 1;
                $return['msg'] = $error;

                $transaction->rollBack();
            }
        }else{
            
        	foreach($model->getErrors() as $val){
                $error .= '<li>'.$val[0].'</li>';
            }
            
            $return['error'] = 1;
            $return['msg'] = $error;

            $transaction->rollBack();
        }
        $error .= '</ul>';

        echo Json::encode($return);
    }

    public function actionDeleteitem(){
        $id = $_POST['id'];

        $model = AtkDetailPembelian::findOne($id);
        $no_pembelian = $model->no_pembelian;

        $header = AtkHeaderPembelian::find()->where('no_pembelian = :nop',[':nop'=>$no_pembelian])->one();

        $return = array();

        if($model->delete()){
            $return['success'] = 1;
            $return['table'] = $this->renderPartial('table_detail',[
                'model'=>$header
            ]);
        }else{
            return $return['success'] = 0;
        }

        echo Json::encode($return);

    }


    public function actionAdmin(){
        $searchModel = new AtkHeaderPembelianSearch();
        $searchModel->tanggal_pembelian = date('Y-m-d');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'dataProvider' => $dataProvider,
            'searchModel'=>$searchModel
        ]);
    }

    /**
     * Deletes an existing AtkFileSupplier model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['admin']);
    }

    /**
     * Updates an existing AtkFileSupplier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $modelDetail = new AtkDetailPembelian();

        //use app\models\Country;
        $lokasi=SettingLokasiStok::find()->where('GudangUtama = 1')->all();

        //use yii\helpers\ArrayHelper;
        $listData=ArrayHelper::map($lokasi,'KodeLokasi','LokasiStok');

        $termin=TabelTermin::find()->all();

        $listTermin = ArrayHelper::map($termin,'KodeTermin','Termin');

        $supplier=AtkFileSupplier::find()->orderBy('NamaSupplier ASC')->all();

        $listSupplier = ArrayHelper::map($supplier,'KodeSupplier','NamaSupplier');

        $data = FileBarangAtk::find()
        ->select(['nama_barang as value', 'nama_barang as  label','kode_barang as id','satuan as sat','ROUND(harga_beli,0) as harga'])
        ->where(['aktif'=>1])
        ->asArray()
        ->all();

        return $this->render('index',[
            'model'=>$model,
            'modelDetail'=>$modelDetail,
            'listData'=>$listData,
            'listTermin'=>$listTermin,
            'listSupplier'=>$listSupplier,
            'data'=>$data
        ]);
    }

    public function actionMutasi(){

        
        $model = new AtkHeaderDistribusi;
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
        
        return $this->render('mutasi',[
            'model'=>$model,
            'modelDetail'=>$modelDetail,
            'listLokasi'=>$listLokasi,
            'data'=>$data
        ]);
    }

    public function actionDeleteitemmutasi(){
        $id = $_POST['id'];

        $model = AtkDetailDistribusi::findOne($id);
        $id_header = $model->id_header_distribusi;

        $header = AtkHeaderDistribusi::find()->where('id_header_distribusi = :id',[':id'=>$id_header])->one();

        $return = array();

        if($model->delete()){
            $return['success'] = 1;
            $return['table'] = $this->renderPartial('table_detail_mutasi',[
                'model'=>$header
            ]);
        }else{
            return $return['success'] = 0;
        }

        echo Json::encode($return);

    }


    /**
     * Finds the AtkFileSupplier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AtkFileSupplier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AtkHeaderPembelian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
