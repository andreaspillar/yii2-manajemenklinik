<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Resep Dokters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resep-dokter-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Resep Dokter', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode_resep',
            [
                'label' => 'Pasien',
                'value' => 'periksa.kunjungan.pasien.nama_pasien',
            ],
            [
                'label' => 'Penyakit',
                'value' => 'periksa.diagnosa',
            ],
            [
                'label' => 'Tanggal Kunjungan',
                'value' => 'periksa.kunjungan.tanggal_kunjungan',
            ],
            [
                'label' => 'Obat',
                'value' => 'barang.nama_barang',
            ],
            'jumlah_barang',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
