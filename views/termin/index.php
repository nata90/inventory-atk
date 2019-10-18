<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TabelTerminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Termin');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-solid box-success">
    <div class="box-header">
        <h3 class="box-title">Kelola Termin</h3>
    </div>
    <div class="box-body">
        <p>
            <?= Html::a(Yii::t('app', 'Tambah Termin'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'KodeTermin',
                'Termin',
                //'JenisMasa',
                //'Masa',

                ['class' => 'yii\grid\ActionColumn', 'template' => '{update}&nbsp;{delete}'],
            ],
        ]); ?>

    </div>
    

</div>
