<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtkSatker;

/**
 * AtkSatkerSearch represents the model behind the search form of `app\models\AtkSatker`.
 */
class AtkSatkerSearch extends AtkSatker
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_satker', 'monitoring', 'last_trans', 'last_date_int'], 'integer'],
            [['nama_satker', 'kode_satker'], 'safe'],
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
        $query = AtkSatker::find();

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
            'id_satker' => $this->id_satker,
            'monitoring' => $this->monitoring,
            'last_trans' => $this->last_trans,
            'last_date_int' => $this->last_date_int,
        ]);

        $query->andFilterWhere(['like', 'nama_satker', $this->nama_satker])
            ->andFilterWhere(['like', 'kode_satker', $this->kode_satker]);

        return $dataProvider;
    }
}
