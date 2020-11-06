<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\Utility;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AtkDetailDistribusiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs(<<<JS
    $(document).on("click", "#xls-rekap-stok", function () {

        var url = $(this).attr('url');

        window.open(url);
    });
JS
);
?>
<div class="atk-detail-rekap-search">
    <div class="box-footer">
        <div class="col-lg-2">
            <div class="input-group">
                <button type="button" id="xls-rekap-stok" class="btn btn-success" url="<?php echo Url::to(['laporan/excelrekap']);?>">Download(.xls)</button>
            </div>
        </div>
    </div>
</div>

<div class="box box-solid box-success">
    <div class="box-header">
        <h3 class="box-title">Laporan Rekap Pembelian dan Mutasi</h3>
    </div>
    <div class="box-body">

        <?php Pjax::begin([
            'id' => 'grid-pembelian', 
            'timeout' => false, 
            'enablePushState'=>false,
            'clientOptions' => ['method' => 'GET']]); ?>
        <?php //echo $this->render('_search_mutasi', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute'=>'tgl_rekap',
                    'format'=>'raw',
                    'value'=>function($model){
                        return date('d-m-Y', strtotime($model->tgl_rekap));
                    },
                ],
                'kode_barang',
                [
                    'attribute'=>'nama_barang',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->barang->nama_barang;
                    },
                ],
                [
                    'attribute'=>'stok_awal',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->stok_awal;
                    },
                    'filter'=>false
                ],
                [
                    'attribute'=>'stok_masuk',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->stok_masuk;
                    },
                    'filter'=>false
                ],
                [
                    'attribute'=>'stok_keluar',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->stok_keluar;
                    },
                    'filter'=>false
                ],
                [
                    'attribute'=>'stok_akhir',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->stok_awal + $model->stok_masuk - $model->stok_keluar;
                    },
                    'filter'=>false
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
    

</div>
