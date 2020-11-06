<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtkDetailPembelian */

$this->title = Yii::t('app', 'Create Atk Detail Pembelian');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Atk Detail Pembelians'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atk-detail-pembelian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
