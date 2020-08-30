<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LaporanPeriksaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="laporan-periksa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kode_laporan') ?>

    <?= $form->field($model, 'no_kunjungan') ?>

    <?= $form->field($model, 'diagnosa') ?>

    <?= $form->field($model, 'tindakan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
