<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = 'Jadwal Kunjungans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwal-kunjungan-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'no_kunjungan',
            'tanggal_kunjungan',
            [
                'attribute' => 'kode_pasien',
                'value' => 'pasien.nama_pasien'
            ],
            [
                'attribute' => 'nomor_induk_karyawan',
                'value' => 'staff.nama_tenaga_medis'
            ],

            [
                'label' => 'Buat Laporan',
                'format' => 'raw',
                'value' => function($data){
                        return Html::a('Laporan Periksa',
                            Url::to(['laporan-periksa/create-by-id','id' => $data->no_kunjungan]),
                        );
                    }
            ],
        ],
    ]); ?>


</div>
