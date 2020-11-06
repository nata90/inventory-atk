<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtkSatkerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-solid box-success">
    <div class="box-header">
        <h3 class="box-title">Satker</h3>
    </div>
    <div class="box-body">
        <p>
            <?= Html::a(Yii::t('app', 'Buat Satker'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id_satker',
                'nama_satker',
                //'kode_satker',
                //'monitoring',
                //'last_trans',
                //'last_date_int',

                ['class' => 'yii\grid\ActionColumn', 'template' => '{update}&nbsp;{delete}'],
            ],
        ]); ?>
    </div>
    

</div>
