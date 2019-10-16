<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "atk_detail_distribusi".
 *
 * @property int $id_detail_distribusi
 * @property int $id_header_distribusi
 * @property string $kode_barang
 * @property double $jumlah_distribusi
 * @property string $create_time
 */
class AtkDetailDistribusi extends \yii\db\ActiveRecord
{
    public $nama_barang;
    public $satuan;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atk_detail_distribusi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_header_distribusi'], 'integer'],
            [['jumlah_distribusi'], 'number'],
            [['create_time'], 'safe'],
            [['kode_barang'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_detail_distribusi' => Yii::t('app', 'Id Detail Distribusi'),
            'id_header_distribusi' => Yii::t('app', 'Id Header Distribusi'),
            'kode_barang' => Yii::t('app', 'Kode Barang'),
            'jumlah_distribusi' => Yii::t('app', 'Jumlah Distribusi'),
            'create_time' => Yii::t('app', 'Create Time'),
        ];
    }

    public function getHeader(){
        return $this->hasOne(AtkHeaderDistribusi::className(), ['id_header_distribusi' => 'id_header_distribusi']);
    }

    public function getBarang(){
        return $this->hasOne(FileBarangAtk::className(), ['kode_barang' => 'kode_barang']);
    }
}
