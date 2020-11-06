<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AtkHeaderDistribusiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atk-header-distribusi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_header_distribusi') ?>

    <?= $form->field($model, 'no_distribusi') ?>

    <?= $form->field($model, 'tgl_distribusi') ?>

    <?= $form->field($model, 'lokasi_asal') ?>

    <?= $form->field($model, 'lokasi_distribusi') ?>

    <?php // echo $form->field($model, 'no_referensi') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'tgl_create') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
