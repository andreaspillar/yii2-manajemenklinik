<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResepDokter */

$this->title = 'Update Resep Dokter: ' . $model->kode_resep;
$this->params['breadcrumbs'][] = ['label' => 'Resep Dokters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_resep, 'url' => ['view', 'id' => $model->kode_resep]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resep-dokter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
