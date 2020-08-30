<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StaffDokter */

$this->title = 'Update Staff Dokter: ' . $model->nomor_induk_karyawan;
$this->params['breadcrumbs'][] = ['label' => 'Staff Dokters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nomor_induk_karyawan, 'url' => ['view', 'id' => $model->nomor_induk_karyawan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="staff-dokter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
