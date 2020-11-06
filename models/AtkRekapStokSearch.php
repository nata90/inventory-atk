<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtkRekapStok;
use Yii;

/**
 * AtkRekapStokSearch represents the model behind the search form of `app\models\AtkRekapStok`.
 */
class AtkRekapStokSearch extends AtkRekapStok
{
    public $nama_barang;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'stok_awal', 'stok_masuk', 'stok_keluar'], 'integer'],
            [['tgl_rekap', 'kode_barang','nama_barang'], 'safe'],
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
        $query = AtkRekapStok::find()->joinWith('barang');

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
            'tgl_rekap' => $this->tgl_rekap,
            'stok_awal' => $this->stok_awal,
            'stok_masuk' => $this->stok_masuk,
            'stok_keluar' => $this->stok_keluar,
            //'file_barang_atk.nama_barang' => $this->nama_barang,
        ]);

        $query->andFilterWhere(['like', 'kode_barang', $this->kode_barang]);
        $query->andFilterWhere(['like', 'file_barang_atk.nama_barang', $this->nama_barang]);

        Yii::$app->session['tgl_rekap'] = $this->tgl_rekap;

        return $dataProvider;
    }
}
