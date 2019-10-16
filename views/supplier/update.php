<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtkFileSupplier */

$this->title = 'Update Supplier: ' . $model->KodeSupplier;
$this->params['breadcrumbs'][] = ['label' => 'Supplier', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->KodeSupplier, 'url' => ['view', 'id' => $model->KodeSupplier]];
$this->params['breadcrumbs'][] = 'Update';
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