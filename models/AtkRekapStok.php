<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "atk_rekap_stok".
 *
 * @property int $id
 * @property string $tgl_rekap
 * @property string $kode_barang
 * @property int $stok_awal
 * @property int $stok_masuk
 * @property int $stok_keluar
 */
class AtkRekapStok extends \yii\db\ActiveRecord
{
    public $nama_barang;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atk_rekap_stok';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_rekap', 'kode_barang', 'stok_awal', 'stok_masuk', 'stok_keluar'], 'required'],
            [['tgl_rekap','nama_barang'], 'safe'],
            [['stok_awal', 'stok_masuk', 'stok_keluar'], 'integer'],
            [['kode_barang'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tgl_rekap' => Yii::t('app', 'Tgl Rekap'),
            'kode_barang' => Yii::t('app', 'Kode Barang'),
            'stok_awal' => Yii::t('app', 'Stok Awal'),
            'stok_masuk' => Yii::t('app', 'Stok Masuk'),
            'stok_keluar' => Yii::t('app', 'Stok Keluar'),
        ];
    }

    public function getBarang(){
        return $this->hasOne(FileBarangAtk::className(), ['kode_barang' => 'kode_barang']);
    }
}
