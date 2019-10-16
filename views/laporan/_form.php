<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtkDetailPembelian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atk-detail-pembelian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_pembelian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_barang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'satuan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jumlah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'harga')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HNA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HPP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
