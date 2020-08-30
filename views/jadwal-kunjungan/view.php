<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\JadwalKunjungan */

$this->title = $model->no_kunjungan;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Kunjungans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="jadwal-kunjungan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->no_kunjungan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->no_kunjungan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no_kunjungan',
            'tanggal_kunjungan',
            [
                'attribute' => 'kode_pasien',
                'value' => $model->pasien->nama_pasien,
            ],
            [
                'attribute' => 'nomor_induk_karyawan',
                'value' => $model->staff->nama_tenaga_medis,
            ],
        ],
    ]) ?>

</div>
