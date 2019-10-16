<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FileBarangAtk;

/**
 * FileBarangAtkSearch represents the model behind the search form of `app\models\FileBarangAtk`.
 */
class FileBarangAtkSearch extends FileBarangAtk
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'stok', 'aktif'], 'integer'],
            [['kode_barang', 'nama_barang', 'satuan', 'kode_kelompok', 'kode_supplier', 'tanggal_pembelian', 'create_time'], 'safe'],
            [['harga_beli'], 'number'],
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
        $query = FileBarangAtk::find()->where('aktif = 1');

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
            'id' => $this->id,
            //'tanggal_pembelian' => $this->tanggal_pembelian,
            'harga_beli' => $this->harga_beli,
            'stok' => $this->stok,
            'aktif' => $this->aktif,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'kode_barang', $this->kode_barang])
            ->andFilterWhere(['like', 'nama_barang', $this->nama_barang])
            ->andFilterWhere(['like', 'satuan', $this->satuan])
            ->andFilterWhere(['like', 'kode_kelompok', $this->kode_kelompok])
            ->andFilterWhere(['like', 'kode_supplier', $this->kode_supplier]);

        return $dataProvider;
    }
}
