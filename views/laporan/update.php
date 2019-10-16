<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtkDetailPembelian */

$this->title = Yii::t('app', 'Update Atk Detail Pembelian: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Atk Detail Pembelians'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="atk-detail-pembelian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
