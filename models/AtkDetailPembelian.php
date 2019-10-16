<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "atk_detail_pembelian".
 *
 * @property int $id
 * @property string $no_pembelian
 * @property string $kode_barang
 * @property string $satuan
 * @property string $jumlah
 * @property string $harga
 * @property string $discount
 * @property string $HNA
 * @property string $HPP
 * @property string $create_time
 */
class AtkDetailPembelian extends \yii\db\ActiveRecord
{
    public $nama_barang;
    public $total;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atk_detail_pembelian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_barang','nama_barang','jumlah', 'harga'], 'required'],
            [['jumlah', 'harga', 'discount', 'HNA', 'HPP'], 'number'],
            [['create_time','nama_barang','total'], 'safe'],
            [['no_pembelian', 'kode_barang'], 'string', 'max' => 15],
            [['satuan'], 'string', 'max' => 7],
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
            'kode_barang' => 'Kode Barang',
            'nama_barang' => 'Nama Barang',
            'satuan' => 'Satuan',
            'jumlah' => 'Jumlah',
            'harga' => 'Harga',
            'discount' => 'Discount',
            'HNA' => 'Hna',
            'HPP' => 'Hpp',
            'create_time' => 'Create Time',
        ];
    }

    public function getBarang(){
        return $this->hasOne(FileBarangAtk::className(), ['kode_barang' => 'kode_barang']);
    }

    public function getHeader(){
        return $this->hasOne(AtkHeaderPembelian::className(), ['no_pembelian' => 'no_pembelian']);
    }
}
