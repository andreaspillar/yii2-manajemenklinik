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
            'kode_laporan',
            'id_barang',
            'jumlah_barang',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
