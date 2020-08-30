<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_kunjungan_dokter".
 *
 * @property string $no_kunjungan
 * @property string $tanggal_kunjungan
 * @property string $kode_pasien
 * @property int $nomor_induk_karyawan
 *
 * @property TblStaffDok $nomorIndukKaryawan
 * @property TblDataPasien $kodePasien
 */
class JadwalKunjungan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_kunjungan_dokter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_kunjungan', 'tanggal_kunjungan', 'kode_pasien', 'nomor_induk_karyawan'], 'required'],
            [['tanggal_kunjungan', 'namadok'], 'safe'],
            [['nomor_induk_karyawan'], 'integer'],
            [['no_kunjungan', 'kode_pasien'], 'string', 'max' => 128],
            [['no_kunjungan'], 'unique'],
            [['nomor_induk_karyawan'], 'exist', 'skipOnError' => true, 'targetClass' => StaffDokter::className(), 'targetAttribute' => ['nomor_induk_karyawan' => 'nomor_induk_karyawan']],
            [['kode_pasien'], 'exist', 'skipOnError' => true, 'targetClass' => DataPasien::className(), 'targetAttribute' => ['kode_pasien' => 'kode_pasien']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'no_kunjungan' => 'No Daftar',
            'tanggal_kunjungan' => 'Tanggal Kunjungan',
            'kode_pasien' => 'Pasien',
            'nomor_induk_karyawan' => 'Dokter',
        ];
    }

    public function getStaff()
    {
        return $this->hasOne(StaffDokter::className(), ['nomor_induk_karyawan' => 'nomor_induk_karyawan']);
    }

    public function getPasien()
    {
        return $this->hasOne(DataPasien::className(), ['kode_pasien' => 'kode_pasien']);
    }
}
