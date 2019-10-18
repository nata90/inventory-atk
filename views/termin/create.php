<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TabelTermin */

$this->title = Yii::t('app', 'Buat Termin');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tabel Termins'), 'url' => ['index']];
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
