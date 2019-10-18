<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtkSatkerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atk-satker-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_satker') ?>

    <?= $form->field($model, 'nama_satker') ?>

    <?= $form->field($model, 'kode_satker') ?>

    <?= $form->field($model, 'monitoring') ?>

    <?= $form->field($model, 'last_trans') ?>

    <?php // echo $form->field($model, 'last_date_int') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
