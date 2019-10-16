<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\AtkSatker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AtkHeaderDistribusiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Kelola Distribusi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-solid box-success">
    <div class="box-header">
        <h3 class="box-title">Barang</h3>
    </div>
    <div class="box-body">

    <?php Pjax::begin([
        'id' => 'grid-mutasi', 
        'timeout' => false, 
        'enablePushState'=>false,
        'clientOptions' => ['method' => 'GET']]
    ); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_header_distribusi',
            'no_distribusi',
            //'tgl_distribusi',
            [
                'attribute'=>'tgl_distribusi',
                'filter' => \yii\jui\DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'tgl_distribusi',
                    'language' => 'en',
                    'dateFormat' => 'dd-MM-yyyy',
                    'options'=>[
                        'class'=>'form-control'
                    ]
                ]),
                'format' => 'html',
                'value'=>function($model){
                    return date('d-m-Y', strtotime($model->tgl_distribusi));
                }
            ],
            [
                'attribute'=>'lokasi_asal',
                'filter'=>ArrayHelper::map(AtkSatker::find()->orderBy('nama_satker ASC')->asArray()->all(), 'id_satker', 'nama_satker'),
                'format'=>'raw',
                'value'=>function($model){
                    return $model->lokasiasal->nama_satker;
                }
            ],
            [
                'attribute'=>'lokasi_distribusi',
                'filter'=>ArrayHelper::map(AtkSatker::find()->orderBy('nama_satker ASC')->asArray()->all(), 'id_satker', 'nama_satker'),
                'format'=>'raw',
                'value'=>function($model){
                    return $model->distribusi->nama_satker;
                }
            ],
            'no_referensi',
            'keterangan',
            //'user_id',
            //'tgl_create',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update}&nbsp;{delete}'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

    </div>
    

</div>
