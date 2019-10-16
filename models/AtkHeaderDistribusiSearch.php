<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtkHeaderDistribusi;

/**
 * AtkHeaderDistribusiSearch represents the model behind the search form of `app\models\AtkHeaderDistribusi`.
 */
class AtkHeaderDistribusiSearch extends AtkHeaderDistribusi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_header_distribusi'], 'integer'],
            [['no_distribusi', 'tgl_distribusi', 'lokasi_asal', 'lokasi_distribusi', 'no_referensi', 'keterangan', 'user_id', 'tgl_create'], 'safe'],
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
        $query = AtkHeaderDistribusi::find();

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
            'id_header_distribusi' => $this->id_header_distribusi,
            'tgl_distribusi' => $this->tgl_distribusi,
            'tgl_create' => $this->tgl_create,
        ]);

        $query->andFilterWhere(['like', 'no_distribusi', $this->no_distribusi])
            ->andFilterWhere(['like', 'lokasi_asal', $this->lokasi_asal])
            ->andFilterWhere(['like', 'lokasi_distribusi', $this->lokasi_distribusi])
            ->andFilterWhere(['like', 'no_referensi', $this->no_referensi])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'user_id', $this->user_id]);

        $query->orderBy('id_header_distribusi DESC');

        return $dataProvider;
    }
}
