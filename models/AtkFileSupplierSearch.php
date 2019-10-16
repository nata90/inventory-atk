<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtkFileSupplier;

/**
 * AtkFileSupplierSearch represents the model behind the search form of `app\models\AtkFileSupplier`.
 */
class AtkFileSupplierSearch extends AtkFileSupplier
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['KodeSupplier', 'NamaSupplier', 'AlamatSupplier', 'KotaSupplier', 'NoTelepon', 'NoFaximili', 'NPWP', 'KontakPerson', 'KodeTermin'], 'safe'],
            [['SaldoHutang'], 'number'],
            [['urut'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AtkFileSupplier::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'SaldoHutang' => $this->SaldoHutang,
            'urut' => $this->urut,
        ]);

        $query->andFilterWhere(['like', 'KodeSupplier', $this->KodeSupplier])
            ->andFilterWhere(['like', 'NamaSupplier', $this->NamaSupplier])
            ->andFilterWhere(['like', 'AlamatSupplier', $this->AlamatSupplier])
            ->andFilterWhere(['like', 'KotaSupplier', $this->KotaSupplier])
            ->andFilterWhere(['like', 'NoTelepon', $this->NoTelepon])
            ->andFilterWhere(['like', 'NoFaximili', $this->NoFaximili])
            ->andFilterWhere(['like', 'NPWP', $this->NPWP])
            ->andFilterWhere(['like', 'KontakPerson', $this->KontakPerson])
            ->andFilterWhere(['like', 'KodeTermin', $this->KodeTermin]);

        return $dataProvider;
    }
}
