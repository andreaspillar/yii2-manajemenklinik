<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staff Dokters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-dokter-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::$app->user->identity->user_access == 1 ? Html::a('Create Staff Dokter', ['create'], ['class' => 'btn btn-success']) : '' ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nomor_induk_karyawan',
            'nama_tenaga_medis',
            'gender',
            'tgl_lahir',
            'tempat_lahir',


            [
                'class' => 'yii\grid\ActionColumn',
                'visible' => Yii::$app->user->identity->user_access == 1
            ],
        ],
    ]); ?>


</div>
