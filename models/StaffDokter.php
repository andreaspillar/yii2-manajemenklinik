<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_staff_dok".
 *
 * @property int $nomor_induk_karyawan
 * @property string $nama_tenaga_medis
 * @property string $jenis_kelamin
 * @property string $tgl_lahir
 * @property string $tempat_lahir
 * @property string $alamat
 * @property int $id_user
 *
 * @property TblDataJadwalDokter[] $tblDataJadwalDokters
 * @property TblUserAccess $user
 */
class StaffDokter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_staff_dok';
    }

    public function rules()
    {
        return [
            [['nama_tenaga_medis', 'jenis_kelamin', 'tgl_lahir', 'tempat_lahir', 'alamat', 'id_user'], 'required'],
            [['tgl_lahir'], 'safe'],
            [['alamat'], 'string'],
            [['id_user'], 'integer'],
            [['nama_tenaga_medis'], 'match', 'pattern' => '/^[a-zA-Z]+(?:\s[a-zA-Z,.]+)*$/', 'message' => 'Nama hanya boleh huruf'],
            [['jenis_kelamin'], 'string', 'max' => 1],
            [['tempat_lahir'], 'string', 'max' => 64],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => UserAccess::className(), 'targetAttribute' => ['id_user' => 'id_user']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'nomor_induk_karyawan' => 'Nomor Induk Karyawan',
            'nama_tenaga_medis' => 'Nama Tenaga Medis',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tgl_lahir' => 'Tgl Lahir',
            'tempat_lahir' => 'Tempat Lahir',
            'alamat' => 'Alamat',
            'id_user' => 'Id User',
        ];
    }


    public function getTblDataJadwalDokters()
    {
        return $this->hasMany(TblDataJadwalDokter::className(), ['nomor_induk_karyawan' => 'nomor_induk_karyawan']);
    }

    public function getUser()
    {
        return $this->hasOne(UserAccess::className(), ['id_user' => 'id_user']);
    }

    public function getGender()
    {
        return $this->jenis_kelamin == 1 ? 'Perempuan' : 'Laki-laki';
    }
}
