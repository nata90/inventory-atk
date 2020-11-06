<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file_barang_atk".
 *
 * @property int $id
 * @property string $kode_barang
 * @property string $nama_barang
 * @property string $satuan
 * @property string $kode_kelompok
 * @property string $kode_supplier
 * @property string $tanggal_pembelian
 * @property string $harga_beli
 * @property int $aktif
 * @property string $create_time
 */
class FileBarangAtk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_barang_atk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_barang', 'nama_barang', 'kode_kelompok'], 'required'],
            [['tanggal_pembelian', 'create_time','stok'], 'safe'],
            [['harga_beli'], 'number'],
            [['aktif','stok'], 'integer'],
            [['kode_barang'], 'string', 'max' => 15],
            [['nama_barang'], 'string', 'max' => 200],
            [['satuan', 'kode_supplier'], 'string', 'max' => 10],
            [['kode_kelompok'], 'string', 'max' => 5],
            [['kode_barang'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_barang' => 'Kode Barang',
            'nama_barang' => 'Nama Barang',
            'satuan' => 'Satuan',
            'kode_kelompok' => 'Kode Kelompok',
            'kode_supplier' => 'Supplier',
            'tanggal_pembelian' => 'Tanggal Pembelian',
            'harga_beli' => 'Harga Beli',
            'aktif' => 'Aktif',
            'create_time' => 'Create Time',
            'stok'=>'Stok'
        ];
    }

    public function getSupplier()

    {

        return $this->hasOne(AtkFileSupplier::className(), ['KodeSupplier' => 'kode_supplier']);

    }

    public function getKelompok(){
        return $this->hasOne(TabelKelompok::className(), ['KodeKelompok' => 'kode_kelompok']);
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {

            $this->tanggal_pembelian = date('Y-m-d', strtotime($this->tanggal_pembelian));

            return true;
        }

        return false;
    }

}
