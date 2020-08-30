<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\DataPasien;
use app\models\StaffDokter;

/* @var $this yii\web\View */
/* @var $model app\models\JadwalKunjungan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jadwal-kunjungan-form">
    <?php 
        $user = DataPasien::find()->all();
        $arrUser = ArrayHelper::map($user, 'kode_pasien', 'nama_pasien');
        $dokter = StaffDokter::find()->all();;
        $arrDokter = ArrayHelper::map($dokter, 'nomor_induk_karyawan', 'nama_tenaga_medis');
    ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_kunjungan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_kunjungan')->widget(\yii\jui\DatePicker::classname(), array(
    'language' => 'id',
    'dateFormat' => 'yyyy/M/dd',
    'options' => [
        'changeYear' => true,
        'changeMonth' => true,
    ]
    )); ?>

    <?= $form->field($model, 'kode_pasien')->dropDownList($arrUser, ['prompt' => 'Pilih...']) ?>

    <?= $form->field($model, 'nomor_induk_karyawan')->dropDownList($arrDokter, ['prompt' => 'Pilih...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
