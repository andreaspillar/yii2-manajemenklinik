<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MasterBarangSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-barang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_barang') ?>

    <?= $form->field($model, 'nama_barang') ?>

    <?= $form->field($model, 'produsen') ?>

    <?= $form->field($model, 'harga') ?>

    <?= $form->field($model, 'satuan') ?>

    <?php // echo $form->field($model, 'stok_barang') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
