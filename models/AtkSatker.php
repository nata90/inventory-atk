<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "satker".
 *
 * @property int $id_satker
 * @property string $nama_satker
 * @property string $kode_satker
 * @property int $monitoring
 * @property int $last_trans
 * @property int $last_date_int
 */
class AtkSatker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'satker';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_satker'], 'required'],
            [['monitoring', 'last_trans', 'last_date_int'], 'integer'],
            [['nama_satker'], 'string', 'max' => 50],
            [['kode_satker'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_satker' => Yii::t('app', 'Id Satker'),
            'nama_satker' => Yii::t('app', 'Nama Satker'),
            'kode_satker' => Yii::t('app', 'Kode Satker'),
            'monitoring' => Yii::t('app', 'Monitoring'),
            'last_trans' => Yii::t('app', 'Last Trans'),
            'last_date_int' => Yii::t('app', 'Last Date Int'),
        ];
    }
}
