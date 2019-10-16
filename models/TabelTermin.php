<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tabeltermin".
 *
 * @property string $KodeTermin
 * @property string $Termin
 * @property int $JenisMasa
 * @property int $Masa
 */
class TabelTermin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tabeltermin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['KodeTermin'], 'required'],
            [['JenisMasa', 'Masa'], 'integer'],
            [['KodeTermin'], 'string', 'max' => 5],
            [['Termin'], 'string', 'max' => 50],
            [['KodeTermin'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KodeTermin' => 'Kode Termin',
            'Termin' => 'Termin',
            'JenisMasa' => 'Jenis Masa',
            'Masa' => 'Masa',
        ];
    }
}
