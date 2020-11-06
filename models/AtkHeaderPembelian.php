<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "atk_header_pembelian".
 *
 * @property int $id
 * @property string $no_pembelian
 * @property string $kode_lokasi
 * @property string $tanggal_pembelian
 * @property string $kode_termin
 * @property string $tanggal_jatuh_tempo
 * @property string $kode_supplier
 * @property string $no_referensi
 * @property string $keterangan
 * @property string $total_pembelian
 * @property string $potongan_pembelian
 * @property string $ppn
 * @property string $biaya_pembelian
 * @property string $pembelian_bersih
 * @property string $saldo_pembelian
 * @property string $user_id
 */
class AtkHeaderPembelian extends \yii\db\ActiveRecord
{
    public $nama_supplier;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atk_header_pembelian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_termin','kode_lokasi','kode_supplier'], 'required'],
            [['tanggal_pembelian', 'tanggal_jatuh_tempo','nama_supplier'], 'safe'],
            [['total_pembelian', 'potongan_pembelian', 'ppn', 'biaya_pembelian', 'pembelian_bersih', 'saldo_pembelian'], 'number'],
            [['no_pembelian', 'no_referensi'], 'string', 'max' => 15],
            [['kode_lokasi'], 'string', 'max' => 5],
            [['kode_termin'], 'string', 'max' => 6],
            [['kode_supplier', 'user_id'], 'string', 'max' => 10],
            [['keterangan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_pembelian' => 'No Pembelian',
            'kode_lokasi' => 'Kode Lokasi',
            'tanggal_pembelian' => 'Tanggal Pembelian',
            'kode_termin' => 'Kode Termin',
            'tanggal_jatuh_tempo' => 'Tanggal Jatuh Tempo',
            'kode_supplier' => 'Supplier',
            'no_referensi' => 'No Referensi',
            'keterangan' => 'Keterangan',
            'total_pembelian' => 'Total Pembelian',
            'potongan_pembelian' => 'Potongan Pembelian',
            'ppn' => 'Ppn',
            'biaya_pembelian' => 'Biaya Pembelian',
            'pembelian_bersih' => 'Pembelian Bersih',
            'saldo_pembelian' => 'Saldo Pembelian',
            'user_id' => 'User ID',
            'nama_supplier' => 'Nama Supplier',
        ];
    }

    public static function getNoTransaksiPembelian(){
        $model = SettingFormulir::find()->where('KodeLokasi = "ATK"')->one();

        if($model != null)
            return $model->Inisial.$model->NomerTerakhir;
        else
            return '-';

    }

    public function getDetail(){
        return $this->hasMany(AtkDetailPembelian::className(), ['no_pembelian' => 'no_pembelian']);
    }

    public function getTermin(){
        return $this->hasOne(TabelTermin::className(), ['KodeTermin' => 'kode_termin']);
    }

    public function getSupplier(){
        return $this->hasOne(AtkFileSupplier::className(), ['KodeSupplier' => 'kode_supplier']);
    }

    public function search($params) {
        $query = AtkHeaderPembelian::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort'=> ['defaultOrder' => ['urut' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'tanggal_pembelian' => date('Y-m-d',strtotime($this->tanggal_pembelian)),
        ]);

        return $dataProvider;
    }


    public function beforeValidate()
    {
        if (parent::beforeValidate()) {

            $this->tanggal_pembelian = date('Y-m-d', strtotime($this->tanggal_pembelian));
            $this->tanggal_jatuh_tempo = date('Y-m-d', strtotime($this->tanggal_jatuh_tempo));

            return true;
        }

        return false;
    }
}
