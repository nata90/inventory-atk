<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtkHeaderDistribusi */

$this->title = Yii::t('app', 'Update Atk Header Distribusi: {name}', [
    'name' => $model->id_header_distribusi,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Atk Header Distribusis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_header_distribusi, 'url' => ['view', 'id' => $model->id_header_distribusi]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="atk-header-distribusi-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
