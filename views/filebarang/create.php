<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FileBarangAtk */

$this->title = 'Buat Barang';
$this->params['breadcrumbs'][] = ['label' => 'Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<div class="col-md-8">

	    <div class="box box-primary">
		    <?= $this->render('_form', [
		        'model' => $model,
		        'listData'=>$listData,
		        'listSupplier'=>$listSupplier
		    ]) ?>
		</div>

	</div>
</div>
