<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\LaporanPeriksa */

$this->title = $model->kode_laporan;
$this->params['breadcrumbs'][] = ['label' => 'Laporan Periksas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="laporan-periksa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->kode_laporan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->kode_laporan], [
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
            'kode_laporan',
            'no_kunjungan',
            [
                'label' => 'Tanggal',
                'value' => $model->kunjungan->tanggal_kunjungan,
            ],
            [
                'label' => 'Pasien',
                'value' => $model->kunjungan->pasien->nama_pasien,
            ],
            [
                'label' => 'Dokter',
                'value' => $model->kunjungan->staff->nama_tenaga_medis,
            ],
            'diagnosa:ntext',
            'tindakan:ntext',
        ],
        ]) ?>

    <h1>Resep Dokter</h1>
    <?= GridView::widget([
            'dataProvider' => $resep,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'Obat',
                    'value' => 'barang.nama_barang'
                ],
                [
                    'label' => 'Harga',
                    'value' => 'barang.harga'
                ],
                'jumlah_barang',                
            ],
    ]); ?>

</div>
