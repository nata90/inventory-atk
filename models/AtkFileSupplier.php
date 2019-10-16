<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "filesupplier".
 *
 * @property string $KodeSupplier
 * @property string $NamaSupplier
 * @property string $AlamatSupplier
 * @property string $KotaSupplier
 * @property string $NoTelepon
 * @property string $NoFaximili
 * @property string $NPWP
 * @property string $KontakPerson
 * @property string $KodeTermin
 * @property string $SaldoHutang
 */
class AtkFileSupplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'filesupplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['KodeSupplier','NamaSupplier','AlamatSupplier','NoTelepon'], 'required'],
            [['SaldoHutang','urut'], 'number'],
            [['KodeSupplier'], 'string', 'max' => 10],
            [['NamaSupplier', 'AlamatSupplier', 'KotaSupplier', 'KontakPerson'], 'string', 'max' => 50],
            [['NoTelepon', 'NoFaximili', 'NPWP'], 'string', 'max' => 25],
            [['KodeTermin'], 'string', 'max' => 6],
            [['KodeSupplier','urut'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KodeSupplier' => 'Kode Supplier',
            'NamaSupplier' => 'Nama Supplier',
            'AlamatSupplier' => 'Alamat Supplier',
            'KotaSupplier' => 'Kota Supplier',
            'NoTelepon' => 'No Telepon',
            'NoFaximili' => 'No Faximili',
            'NPWP' => 'Npwp',
            'KontakPerson' => 'Contact Person',
            'KodeTermin' => 'Kode Termin',
            'SaldoHutang' => 'Saldo Hutang',
            'urut' => 'Urut',
        ];
    }

    public function search($params) {
        $query = AtkFileSupplier::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['urut' => SORT_DESC]]
        ]);

        /*$dataProvider->setSort([
            'attributes' => [
                'urut'=>[
                    'default'=>SORT_DESC,
                ],
                'fullName' => [
                    'asc' => ['first_name' => SORT_ASC, 'last_name' => SORT_ASC],
                    'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
                    'label' => 'Full Name',
                    'default' => SORT_ASC
                ],
                'country_id'
            ]
        ]);*/

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}
