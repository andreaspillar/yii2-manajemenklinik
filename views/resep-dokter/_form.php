<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\MasterBarang;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResepDokter */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
        $barang = MasterBarang::find()->all();
        $arrBarang = ArrayHelper::map($barang, 'id_barang', 'nama_barang');
    ?>

<div class="resep-dokter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_resep')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_laporan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_barang')->dropDownList($arrBarang, ['prompt' => 'Pilih...']) ?>

    <?= $form->field($model, 'jumlah_barang')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
