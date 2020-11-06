<?php

namespace app\models;

use yii\base\Model;
use Yii;
use yii\data\ActiveDataProvider;
use app\models\AtkDetailPembelian;
use yii\web\Session;

/**
 * AtkDetailDistribusiSearch represents the model behind the search form of `app\models\AtkDetailPembelian`.
 */
class AtkDetailDistribusiSearch extends AtkDetailPembelian
{
    public $tanggal_pembelian;
    public $start_date;
    public $end_date;
    public $id_detail_distribusi;
    public $id_header_distribusi;
    public $jumlah_distribusi;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['no_pembelian', 'kode_barang', 'satuan', 'create_time','tanggal_pembelian','start_date','end_date'], 'safe'],
            [['jumlah', 'harga', 'discount', 'HNA', 'HPP'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'start_date' => 'Tangal Mulai',
            'end_date' => 'Sampai',
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

        $query = AtkDetailPembelian::find()->joinWith('header');

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
            'jumlah' => $this->jumlah,
            'harga' => $this->harga,
            'discount' => $this->discount,
            'HNA' => $this->HNA,
            'HPP' => $this->HPP,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'atk_detail_pembelian.no_pembelian', $this->no_pembelian])
            ->andFilterWhere(['like', 'kode_barang', $this->kode_barang])
            ->andFilterWhere(['between', 'atk_header_pembelian.tanggal_pembelian', date('Y-m-d', strtotime($this->start_date))." 00:00:00", date('Y-m-d', strtotime($this->end_date))." 23:59:59"])
            ->andFilterWhere(['like', 'satuan', $this->satuan]);

        Yii::$app->session['start_date'] = date('Y-m-d', strtotime($this->start_date));
        Yii::$app->session['end_date'] = date('Y-m-d', strtotime($this->end_date));

        return $dataProvider;
    }

    public function searchMutasi($params)
    {
        $query = AtkDetailDistribusi::find()->joinWith('header');

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
            'id_detail_distribusi' => $this->id_detail_distribusi,
            'id_header_distribusi' => $this->id_header_distribusi,
            'kode_barang' => $this->kode_barang,
            'jumlah_distribusi' => $this->jumlah_distribusi,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['between', 'atk_header_distribusi.tgl_distribusi', date('Y-m-d', strtotime($this->start_date)), date('Y-m-d', strtotime($this->end_date))]);

        Yii::$app->session['start_date_mutasi'] = date('Y-m-d', strtotime($this->start_date));
        Yii::$app->session['end_date_mutasi'] = date('Y-m-d', strtotime($this->end_date));

        return $dataProvider;
    }

    public function getBarang(){
        return $this->hasOne(FileBarangAtk::className(), ['kode_barang' => 'kode_barang']);
    }
}
