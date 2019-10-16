<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtkHeaderPembelian;

/**
 * AtkHeaderPembelianSearch represents the model behind the search form of `app\models\AtkHeaderPembelian`.
 */
class AtkHeaderPembelianSearch extends AtkHeaderPembelian
{
    public $nama_supplier;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['no_pembelian', 'kode_lokasi', 'tanggal_pembelian', 'kode_termin', 'tanggal_jatuh_tempo', 'kode_supplier', 'no_referensi', 'keterangan', 'user_id','nama_supplier'], 'safe'],
            [['total_pembelian', 'potongan_pembelian', 'ppn', 'biaya_pembelian', 'pembelian_bersih', 'saldo_pembelian'], 'number'],
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
        $query = AtkHeaderPembelian::find()->joinWith('supplier');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tanggal_pembelian' => date('Y-m-d', strtotime($this->tanggal_pembelian)),
            //'tanggal_jatuh_tempo' => $this->tanggal_jatuh_tempo,
            'total_pembelian' => $this->total_pembelian,
            'potongan_pembelian' => $this->potongan_pembelian,
            'ppn' => $this->ppn,
            'biaya_pembelian' => $this->biaya_pembelian,
            'pembelian_bersih' => $this->pembelian_bersih,
            'saldo_pembelian' => $this->saldo_pembelian,
        ]);

        $query->andFilterWhere(['like', 'no_pembelian', $this->no_pembelian])
            ->andFilterWhere(['like', 'kode_lokasi', $this->kode_lokasi])
            ->andFilterWhere(['like', 'kode_termin', $this->kode_termin])
            ->andFilterWhere(['like', 'filesupplier.NamaSupplier', $this->nama_supplier])
            ->andFilterWhere(['like', 'no_referensi', $this->no_referensi])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'user_id', $this->user_id]);

        return $dataProvider;
    }
}
