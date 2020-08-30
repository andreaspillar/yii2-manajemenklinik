<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserAccess */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-access-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['minlength' => 6]) ?>

    <?= $form->field($model, 'user_access')->dropDownList([2 => 'Keuangan', 3 => 'Dokter', 4 => 'Apoteker', 5 => 'Rekam Medis', 6 => 'HR'], ['prompt' => 'Pilih...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
