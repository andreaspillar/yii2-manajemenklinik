<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResepDokter */

$this->title = 'Create Resep Dokter';
$this->params['breadcrumbs'][] = ['label' => 'Resep Dokters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resep-dokter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
