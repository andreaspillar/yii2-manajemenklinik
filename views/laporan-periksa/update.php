<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LaporanPeriksa */

$this->title = 'Update Laporan Periksa: ' . $model->kode_laporan;
$this->params['breadcrumbs'][] = ['label' => 'Laporan Periksas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_laporan, 'url' => ['view', 'id' => $model->kode_laporan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="laporan-periksa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
