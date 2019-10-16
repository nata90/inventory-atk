<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtkFileSupplier */

$this->title = 'Buat Supplier';
$this->params['breadcrumbs'][] = ['label' => 'Supplier', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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

