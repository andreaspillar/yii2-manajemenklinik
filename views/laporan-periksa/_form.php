<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\JadwalKunjungan;

?>

<div class="laporan-periksa-form">
    <?php 
        $user = JadwalKunjungan::find()->all();
        $arrKunjungan = ArrayHelper::map($user, 'no_kunjungan', 'no_kunjungan');
    ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_laporan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_kunjungan')->dropDownList($arrKunjungan, ['prompt' => 'Pilih...']) ?>

    <?= $form->field($model, 'diagnosa')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tindakan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
