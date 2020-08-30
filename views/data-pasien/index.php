<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Pasiens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-pasien-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= (Yii::$app->user->identity->user_access == 1 || Yii::$app->user->identity->user_access == 5) ? Html::a('Create Data Pasien', ['create'], ['class' => 'btn btn-success']) : '' ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode_pasien',
            'nama_pasien',
            'alamat:ntext',
            'gender',
            'tempat_lahir',
            //'tanggal_lahir',

            [
                'class' => 'yii\grid\ActionColumn',
                'visible' => Yii::$app->user->identity->user_access == 1 || Yii::$app->user->identity->user_access == 5
            ],
        ],
    ]); ?>


</div>
