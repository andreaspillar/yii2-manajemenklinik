<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DataPasien */

$this->title = 'Update Data Pasien: ' . $model->kode_pasien;
$this->params['breadcrumbs'][] = ['label' => 'Data Pasiens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_pasien, 'url' => ['view', 'id' => $model->kode_pasien]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-pasien-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
