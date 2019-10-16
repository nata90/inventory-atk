<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtkFileSupplier */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
    <div class="box-body">

        <div class="form-group">
            <?= $form->field($model, 'KodeSupplier')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="form-group">
            <?= $form->field($model, 'NamaSupplier')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'AlamatSupplier')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'KotaSupplier')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'NoTelepon')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'NoFaximili')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'NPWP')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'KontakPerson')->textInput(['maxlength' => true]) ?>
        </div>

        <?php /*<div class="form-group">
            <?= $form->field($model, 'KodeTermin')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'SaldoHutang')->textInput(['maxlength' => true]) ?>
        </div>*/ ?>

    </div>
    <div class="box-footer">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    </div>
<?php ActiveForm::end(); ?>