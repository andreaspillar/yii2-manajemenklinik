<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MasterBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-barang-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Master Barang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_barang',
            'nama_barang',
            'produsen',
            'harga',
            'satuan',
            //'stok_barang',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
