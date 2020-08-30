<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StaffDokter */

$this->title = 'Create Staff Dokter';
$this->params['breadcrumbs'][] = ['label' => 'Staff Dokters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-dokter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
