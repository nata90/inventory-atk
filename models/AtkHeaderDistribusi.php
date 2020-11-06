<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "atk_header_distribusi".
 *
 * @property int $id_header_distribusi
 * @property string $no_distribusi
 * @property string $tgl_distribusi
 * @property string $lokasi_asal
 * @property string $lokasi_distribusi
 * @property string $no_referensi
 * @property string $keterangan
 * @property string $user_id
 * @property string $tgl_create
 */
class AtkHeaderDistribusi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atk_header_distribusi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_distribusi', 'lokasi_asal','lokasi_distribusi'], 'safe'],
            [['lokasi_asal', 'lokasi_distribusi', 'no_referensi'], 'required'],
            [['no_distribusi', 'no_referensi'], 'string', 'max' => 15],
            [['lokasi_asal', 'lokasi_distribusi', 'user_id'], 'string', 'max' => 10],
            [['keterangan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_header_distribusi' => Yii::t('app', 'Id Header Distribusi'),
            'no_distribusi' => Yii::t('app', 'No Distribusi'),
            'tgl_distribusi' => Yii::t('app', 'Tgl Mutasi'),
            'lokasi_asal' => Yii::t('app', 'Lokasi Asal'),
            'lokasi_distribusi' => Yii::t('app', 'Lokasi Distribusi'),
            'no_referensi' => Yii::t('app', 'No Referensi'),
            'keterangan' => Yii::t('app', 'Keterangan'),
            'user_id' => Yii::t('app', 'User ID'),
            'tgl_create' => Yii::t('app', 'Tgl Create'),
        ];
    }

    public function getDetail(){
        return $this->hasMany(AtkDetailDistribusi::className(), ['id_header_distribusi' => 'id_header_distribusi']);
    }

    public function getLokasiasal(){
        return $this->hasOne(AtkSatker::className(), ['id_satker' => 'lokasi_asal']);
    }

    public function getDistribusi(){
        return $this->hasOne(AtkSatker::className(), ['id_satker' => 'lokasi_distribusi']);
    }

    public static function getNoTransaksiMutasi(){
        $model = SettingFormulir::find()->where('KodeLokasi = "MUT"')->one();

        if($model != null)
            return $model->Inisial.$model->NomerTerakhir;
        else
            return '-';

    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {

            $this->tgl_distribusi = date('Y-m-d', strtotime($this->tgl_distribusi));

            return true;
        }

        return false;
    }
}
