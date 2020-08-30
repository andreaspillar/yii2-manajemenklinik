<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JadwalKunjungan */

$this->title = 'Create Jadwal Kunjungan';
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Kunjungans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwal-kunjungan-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
