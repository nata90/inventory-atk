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
    $(document).on("click", "#xls-mutasi", function () {

        var url = $(this).attr('url');

        window.open(url);
    });
JS
);
?>
<div class="box box-solid box-success">
    <div class="box-header">
        <h3 class="box-title">Laporan Mutasi</h3>
    </div>
    <div class="box-body">

        <?php Pjax::begin([
            'id' => 'grid-pembelian', 
            'timeout' => false, 
            'enablePushState'=>false,
            'clientOptions' => ['method' => 'GET']]); ?>
        <?php echo $this->render('_search_mutasi', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                [
                    'attribute'=>'no_distribusi',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->header->no_distribusi;
                    },
                ],
                [
                    'attribute'=>'lokasi_asal',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->header->lokasiasal->nama_satker;
                    },
                ],
                [
                    'attribute'=>'lokasi_distribusi',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->header->distribusi->nama_satker;
                    },
                ],
                'kode_barang',
                [
                    'attribute'=>'nama_barang',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->barang->nama_barang;
                    }
                ],
                [
                    'attribute'=>'tgl_distribusi',
                    'format'=>'raw',
                    'value'=>function($model){
                        return date('d-m-Y', strtotime($model->header->tgl_distribusi));
                    }
                ],
                'jumlah_distribusi',

            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
    

</div>
