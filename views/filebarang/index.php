<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\Utility;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-solid box-success">
    <div class="box-header">
        <h3 class="box-title">Barang</h3>
    </div>
    <div class="box-body">
        <p>
            <?= Html::a('Tambah Barang', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin([
            'id' => 'grid-barang', 
            'timeout' => false, 
            'enablePushState'=>false,
            'clientOptions' => ['method' => 'GET']]
        ); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'kode_barang',
                'nama_barang',
                'satuan',
                [
                    'attribute'=>'kode_kelompok',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->kelompok->KelompokBarang;
                    },
                    'filter'=>false,
                ],
                [
                    'attribute'=>'tanggal_pembelian',
                    'format'=>'raw',
                    'value'=>function ($model) {
                        return date('d-m-Y', strtotime($model->tanggal_pembelian));
                    },
                    'filter'=>false,
                ],
                [
                    'attribute'=>'stok',
                    'format'=>'raw',
                    'value'=>function ($model) {
                        return $model->stok;
                    },
                    'filter'=>false,
                ],
                ['class' => 'yii\grid\ActionColumn', 'template' => '{update}&nbsp;{delete}'],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
    

</div>
