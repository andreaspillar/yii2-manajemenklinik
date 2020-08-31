<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>

databasenya terdapat pada file sim_klinik.sql

relasi pada program yang bisa dicek:

controller:


``` public function actionIndex()
    {
        $searchDokter = StaffDokter::find()->where(['id_user' => Yii::$app->user->identity->id_user])->one();
        $searchKunjungan = JadwalKunjungan::find()->where(['nomor_induk_karyawan' => $searchDokter])->all();
        $searchDiagnosa = LaporanPeriksa::find()->where(['no_kunjungan' => $searchKunjungan])->all();
        $dataProvider = new ActiveDataProvider([
            'query' => ResepDokter::find()->where(['kode_laporan' => $searchDiagnosa]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
```

ini untuk mencari resep berdasarkan user idnya dokter, dimulai dari cari staff, kemudian cari kunjungan berdasarkan id staff, cari laporan periksa berdasarkan no kunjungan, kemudian cari resep berdasarkan kode_laporan


view:

``` <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode_resep',
            [
                'label' => 'Pasien',
                'value' => 'periksa.kunjungan.pasien.nama_pasien',
            ],
            [
                'label' => 'Dokter',
                'value' => 'periksa.kunjungan.staff.nama_tenaga_medis',
            ],
            [
                'label' => 'Obat',
                'value' => 'barang.nama_barang',
            ],
            [
                'label' => 'Obat',
                'value' => 'barang.produsen',
            ],
            'jumlah_barang',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
```

pada label pasien, dokter, dan obat. value dijoin menggunakan operator titik mengambil fungsi getNamafungsi (contoh: barang.nama_barang mengambil fungsi getBarang, yang mana terdapat variabel nama_barang di dalamnya yang dipanggil menggunakan activerecord)


