<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtkHeaderDistribusi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atk-header-distribusi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_distribusi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_distribusi')->textInput() ?>

    <?= $form->field($model, 'lokasi_asal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lokasi_distribusi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_referensi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
