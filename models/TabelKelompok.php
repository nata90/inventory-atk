<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tabelkelompok".
 *
 * @property string $KodeKelompok
 * @property string $KelompokBarang
 * @property string $KodePenjualan
 * @property string $KodeReturPenjualan
 */
class TabelKelompok extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tabelkelompok';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['KodeKelompok'], 'required'],
            [['KodeKelompok'], 'string', 'max' => 5],
            [['KelompokBarang'], 'string', 'max' => 50],
            [['KodePenjualan', 'KodeReturPenjualan'], 'string', 'max' => 15],
            [['KodeKelompok'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KodeKelompok' => 'Kode Kelompok',
            'KelompokBarang' => 'Kelompok Barang',
            'KodePenjualan' => 'Kode Penjualan',
            'KodeReturPenjualan' => 'Kode Retur Penjualan',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TabelkelompokQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TabelkelompokQuery(get_called_class());
    }
}
