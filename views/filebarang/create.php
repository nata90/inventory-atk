<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FileBarangAtk */

$this->title = '';
//$this->params['breadcrumbs'][] = ['label' => 'Barang', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<div class="col-md-8">
		<div class="box box-success box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Barang</h3>
					</div>
		    <?= $this->render('_form', [
		        'model' => $model,
		        'listData'=>$listData,
		        'listSupplier'=>$listSupplier
		    ]) ?>
		</div>

	</div>
</div>
