<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => 
            [
                ['label' => 'Login', 'url' => ['/site/login'], 'visible' => Yii::$app->user->isGuest ],
                !Yii::$app->user->isGuest ? ['label' => 'Data Dokter', 'url' => ['/staff-dokter/index'], 'visible' => Yii::$app->user->identity->user_access == 1 || Yii::$app->user->identity->user_access == 5 ] : '' ,
                !Yii::$app->user->isGuest ? ['label' => 'Data Pasien', 'url' => ['/data-pasien/index'], 'visible' => Yii::$app->user->identity->user_access == 1 || Yii::$app->user->identity->user_access == 3 || Yii::$app->user->identity->user_access == 5 ] : '' ,
                !Yii::$app->user->isGuest ? ['label' => 'Data Kunjungan', 'url' => ['/jadwal-kunjungan/index'], 'visible' => Yii::$app->user->identity->user_access == 1 || Yii::$app->user->identity->user_access == 5 ] : '' ,
                !Yii::$app->user->isGuest ? ['label' => 'Data Kunjungan', 'url' => ['/jadwal-kunjungan/index-dokter-user'], 'visible' =>  Yii::$app->user->identity->user_access == 3 ] : '' ,
                !Yii::$app->user->isGuest ? ['label' => 'Data Periksa', 'url' => ['/laporan-periksa/index'], 'visible' => Yii::$app->user->identity->user_access == 3 || Yii::$app->user->identity->user_access == 5 ] : '' ,
                !Yii::$app->user->isGuest ? ['label' => 'Resep Dokter', 'url' => ['/resep-dokter/index'], 'visible' => Yii::$app->user->identity->user_access == 3 ] : '' ,
                !Yii::$app->user->isGuest ? ['label' => 'Pengeluaran', 'url' => ['/resep-dokter/index-apoteker'], 'visible' => Yii::$app->user->identity->user_access == 4 ] : '' ,
                !Yii::$app->user->isGuest ? ['label' => 'Master Barang', 'url' => ['/master-barang/index'], 'visible' => Yii::$app->user->identity->user_access == 1 || Yii::$app->user->identity->user_access == 4 ] : '' ,
                !Yii::$app->user->isGuest ? ['label' => 'Access Rights', 'url' => ['/user-access/index'], 'visible' => Yii::$app->user->identity->user_access == 1 ] : '' ,
                !Yii::$app->user->isGuest ?
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>': '',
            ]
            // Yii::$app->user->isGuest ? (
            //     [['label' => 'Login', 'url' => ['/site/login']]]
            // ) : (
            //     Yii::$app->user->identity->user_access == 1 ? (
            //         [
            //             ['label' => 'Data User', 'url' => ['/user-access/index']],
            //             ['label' => 'Data Pasien', 'url' => ['/data-pasien/index']],
            //             ['label' => 'Data Dokter', 'url' => ['/staff-dokter/index']],
            //             '<li>'
            //             . Html::beginForm(['/site/logout'], 'post')
            //             . Html::submitButton(
            //                 'Logout (' . Yii::$app->user->identity->username . ')',
            //                 ['class' => 'btn btn-link logout']
            //             )
            //             . Html::endForm()
            //             . '</li>'
            //         ]                    
            //     ) : Yii::$app->user->identity->user_access == 3 ? (
            //             [
            //                 ['label' => 'Jadwal Kunjungan', 'url' => ['/jadwal-kunjungan/index']],
            //                 '<li>'
            //                 . Html::beginForm(['/site/logout'], 'post')
            //                 . Html::submitButton(
            //                     'Logout (' . Yii::$app->user->identity->username . ')',
            //                     ['class' => 'btn btn-link logout']
            //                 )
            //                 . Html::endForm()
            //                 . '</li>'
            //             ]
            //     ) : (
            //         [
            //             '<li>'
            //             . Html::beginForm(['/site/logout'], 'post')
            //             . Html::submitButton(
            //                 'Logout (' . Yii::$app->user->identity->username . ')',
            //                 ['class' => 'btn btn-link logout']
            //             )
            //             . Html::endForm()
            //             . '</li>']
            //     )
                
            // )
    ]
);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
