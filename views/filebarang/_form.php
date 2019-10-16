<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\FileBarangAtk */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
    <div class="box-body">

        <div class="form-group">
            <?= $form->field($model, 'kode_barang')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'nama_barang')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'satuan')->textInput(['maxlength' => true]) ?>
        </div>

         <div class="form-group">
            <?= $form->field($model, 'stok')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'kode_kelompok')->dropDownList(
                $listData,
                ['prompt'=>'Pilih Salah Satu']
            ) ?>
        </div>

        <div class="form-group">

            <?= $form->field($model, 'tanggal_pembelian')->widget(\yii\jui\DatePicker::class, [
                    'options'=>['class'=>'form-control']
               
            ]) ?>
        </div>

        <?php /*<div class="form-group">
            <?= $form->field($model, 'kode_supplier')->dropDownList(
                $listSupplier,
                ['prompt'=>'Pilih Salah Satu']
            ) ?>
        </div>


        <div class="form-group">
            <?= $form->field($model, 'harga_beli')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'aktif')->textInput() ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'create_time')->textInput() ?>
        </div>*/ ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    </div>
<?php ActiveForm::end(); ?>
