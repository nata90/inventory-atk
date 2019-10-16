<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\Utility;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Supplier';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-solid box-success">
    <div class="box-header">
        <h3 class="box-title">Supplier</h3>
    </div>
    <div class="box-body">
        <p>
            <?= Html::a('Tambah Supplier', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'KodeSupplier',
                'NamaSupplier',
                'AlamatSupplier',
                'KotaSupplier',
                'NoTelepon',
                'NoFaximili',
                'NPWP',
                'KontakPerson',
                //'KodeTermin',
                //'SaldoHutang',
                /*[
                    'label'=>'SaldoHutang',
                    'format'=>'raw',
                    'value'=>Utility::rupiah($data),
                ],*/

                ['class' => 'yii\grid\ActionColumn', 'template' => '{update}&nbsp;{delete}'],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
    

</div>
