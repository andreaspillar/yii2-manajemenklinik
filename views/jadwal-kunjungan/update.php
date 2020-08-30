<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JadwalKunjungan */

$this->title = 'Update Jadwal Kunjungan: ' . $model->no_kunjungan;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Kunjungans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_kunjungan, 'url' => ['view', 'id' => $model->no_kunjungan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jadwal-kunjungan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
