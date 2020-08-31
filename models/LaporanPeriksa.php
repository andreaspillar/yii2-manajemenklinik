<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_lap_pemeriksaan".
 *
 * @property string $kode_laporan
 * @property string $no_kunjungan
 * @property string $diagnosa
 * @property string $tindakan
 *
 * @property TblKunjunganDokter $noKunjungan
 * @property TblResepDokter[] $tblResepDokters
 */
class LaporanPeriksa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_lap_pemeriksaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_laporan', 'no_kunjungan', 'diagnosa', 'tindakan'], 'required'],
            [['diagnosa', 'tindakan'], 'string'],
            [['kode_laporan', 'no_kunjungan'], 'string', 'max' => 128],
            [['kode_laporan'], 'unique'],
            [['no_kunjungan'], 'exist', 'skipOnError' => true, 'targetClass' => JadwalKunjungan::className(), 'targetAttribute' => ['no_kunjungan' => 'no_kunjungan']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_laporan' => 'Kode Laporan',
            'no_kunjungan' => 'No Kunjungan',
            'diagnosa' => 'Diagnosa',
            'tindakan' => 'Tindakan',
        ];
    }

    public function getKunjungan()
    {
        return $this->hasOne(JadwalKunjungan::className(), ['no_kunjungan' => 'no_kunjungan']);
    }    

    public function getTblResepDokters()
    {
        return $this->hasMany(ResepDokter::className(), ['kode_laporan' => 'kode_laporan']);
    }
}
