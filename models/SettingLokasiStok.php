<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settinglokasistok".
 *
 * @property string $KodeLokasi
 * @property string $LokasiStok
 * @property int $GudangUtama
 * @property int $Penjualan
 * @property int $Pembelian
 * @property int $StokPositif
 */
class SettingLokasiStok extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settinglokasistok';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['KodeLokasi'], 'required'],
            [['GudangUtama', 'Penjualan', 'Pembelian', 'StokPositif'], 'integer'],
            [['KodeLokasi'], 'string', 'max' => 7],
            [['LokasiStok'], 'string', 'max' => 50],
            [['KodeLokasi'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KodeLokasi' => 'Kode Lokasi',
            'LokasiStok' => 'Lokasi Stok',
            'GudangUtama' => 'Gudang Utama',
            'Penjualan' => 'Penjualan',
            'Pembelian' => 'Pembelian',
            'StokPositif' => 'Stok Positif',
        ];
    }
}
