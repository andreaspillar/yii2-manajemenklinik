<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jadwal Kunjungans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwal-kunjungan-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Jadwal Kunjungan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
