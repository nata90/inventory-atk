<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\Utility;
use yii\helpers\ArrayHelper;
use app\models\TabelTermin;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-solid box-success">
    <div class="box-header">
        <h3 class="box-title">Kelola Pembelian</h3>
    </div>
    <div class="box-body">

        <?php Pjax::begin([
            'id' => 'grid-pembelian', 
            'timeout' => false, 
            'enablePushState'=>false,
            'clientOptions' => ['method' => 'GET']
        ]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'no_pembelian',
                [
                    'attribute'=>'kode_lokasi',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->kode_lokasi;
                    },
                    'filter'=>false
                ],
                [
                    'attribute'=>'tanggal_pembelian',
                    'format'=>'raw',
                    'value'=>function($model){
                        return date('d-m-Y', strtotime($model->tanggal_pembelian));
                    }
                ],
                [
                    'attribute'=>'kode_termin',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->termin->Termin;
                    },
                    'filter'=> ArrayHelper::map(TabelTermin::find()->all(),'KodeTermin','Termin'),
                ],
                [
                    'attribute'=>'nama_supplier',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->supplier->NamaSupplier;
                    }
                ],
                //'kode_lokasi',
                [
                    'attribute'=>'keterangan',
                    'format'=>'raw',
                    'value'=>function($model){
                        return $model->keterangan;
                    },
                    'filter'=>false
                ],
                [
                    'attribute'=>'total_pembelian',
                    'format'=>'raw',
                    'value'=>function($model){
                        return Utility::rupiah($model->total_pembelian);
                    },
                    'filter'=>false
                ],
                ['class' => 'yii\grid\ActionColumn', 'template' => '{update}&nbsp;{delete}'],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
    

</div>
