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
                'label' => 'Dokter',
                'value' => 'periksa.kunjungan.staff.nama_tenaga_medis',
            ],
            [
                'label' => 'Obat',
                'value' => 'barang.nama_barang',
            ],
            [
                'label' => 'Obat',
                'value' => 'barang.produsen',
            ],
            'jumlah_barang',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
