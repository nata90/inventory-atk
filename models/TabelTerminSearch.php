<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TabelTermin;

/**
 * TabelTerminSearch represents the model behind the search form of `app\models\TabelTermin`.
 */
class TabelTerminSearch extends TabelTermin
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['KodeTermin', 'Termin'], 'safe'],
            [['JenisMasa', 'Masa'], 'integer'],
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
        $query = TabelTermin::find();

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
            'JenisMasa' => $this->JenisMasa,
            'Masa' => $this->Masa,
        ]);

        $query->andFilterWhere(['like', 'KodeTermin', $this->KodeTermin])
            ->andFilterWhere(['like', 'Termin', $this->Termin]);

        return $dataProvider;
    }
}
