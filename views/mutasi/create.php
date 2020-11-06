<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtkHeaderDistribusi */

$this->title = Yii::t('app', 'Create Atk Header Distribusi');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Atk Header Distribusis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atk-header-distribusi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
