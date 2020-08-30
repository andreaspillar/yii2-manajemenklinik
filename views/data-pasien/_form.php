<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DataPasien */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-pasien-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_pasien')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_pasien')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'jenis_kelamin')->dropDownList([0 => 'Laki-Laki', 1 => 'Perempuan'], ['prompt' => 'Pilih...']) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir')->widget(\yii\jui\DatePicker::classname(), array(
    'language' => 'id',
    'dateFormat' => 'yyyy/MM/dd',
    'options' => [
        'changeYear' => true,
        'changeMonth' => true,
    ]
    )); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
