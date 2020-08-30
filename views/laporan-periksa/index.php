<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LaporanPeriksaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Periksas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laporan-periksa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::$app->user->identity->user_access == 3 ? Html::a('Create Laporan Periksa', ['create'], ['class' => 'btn btn-success']) : '' ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode_laporan',
            'no_kunjungan',
            'diagnosa:ntext',
            'tindakan:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'visible' => Yii::$app->user->identity->user_access == 3,
            ],
            [
                'label' => 'Buat Resep',
                'format' => 'raw',
                'value' => function($data){
                        return Html::a('Buat Resep',
                            Url::to(['resep-dokter/create-by-id', 'id' => $data->kode_laporan]),
                        );
                    },
                'visible' => Yii::$app->user->identity->user_access == 3,
            ],
        ],
    ]); ?>


</div>
