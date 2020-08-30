<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\base\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\StaffDokter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-dokter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_tenaga_medis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_kelamin')->dropDownList([0 => 'Laki-Laki', 1 => 'Perempuan'], ['prompt' => 'Pilih...']) ?>

    <?= $form->field($model, 'tgl_lahir')->widget(\yii\jui\DatePicker::classname(), array(
    'language' => 'id',
    'dateFormat' => 'yyyy/MM/dd',
    'options' => [
        'changeYear' => true,
        'changeMonth' => true,
    ]
    ));
    ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
