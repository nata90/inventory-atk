<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\Utility;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtkDetailDistribusiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs(<<<JS
    $(document).on("click", "#xls-pembelian", function () {

        var url = $(this).attr('url');

        window.open(url);
    });
JS
);
?>
<div class="box box-solid box-success">
    <div class="box-header">
        <h3 class="box-title">Laporan Pembelian</h3>
    </div>
    <div class="box-body">

        <?php Pjax::begin([
            'id' => 'grid-pembelian', 
            'timeout' => false, 
            'enablePushState'=>false,
            'clientOptions' => ['method' => 'GET']]); ?>
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                [
                    'attribute'=>'no_pembelian',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->no_pembelian;
                    },
                ],
                [
                    'attribute'=>'tgl_pembelian',
                    'format'=>'raw',
                    'value'=>function($model){
                        return date('d-m-Y', strtotime($model->header->tanggal_pembelian));
                    }
                ],
                'kode_barang',
                [
                    'attribute'=>'nama_barang',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->barang->nama_barang;
                    }
                ],
                'satuan',
                //'jumlah',
                [
                    'attribute'=>'jumlah',
                    'format'=>'raw',
                    'value'=>function($model){
                        return round($model->jumlah,0);
                    }
                ],
                [
                    'attribute'=>'harga',
                    'format'=>'raw',
                    'value'=>function($model){
                        return Utility::rupiah($model->harga);
                    }
                ],
                [
                    'attribute'=>'total',
                    'format'=>'raw',
                    'value'=>function($model){
                        return Utility::rupiah($model->harga*$model->jumlah);
                    }
                ],
                //'discount',
                //'HNA',
                //'HPP',
                //'create_time',

                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
    

</div>
