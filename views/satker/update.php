<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtkSatker */

$this->title = Yii::t('app', 'Update Satker: {name}', [
    'name' => $model->id_satker,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Atk Satkers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_satker, 'url' => ['view', 'id' => $model->id_satker]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="row">
	<div class="col-md-8">

	    <div class="box box-primary">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>

	</div>
</div>
