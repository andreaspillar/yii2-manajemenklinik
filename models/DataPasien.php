<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_data_pasien".
 *
 * @property string $kode_pasien
 * @property string $nama_pasien
 * @property string $alamat
 * @property string $jenis_kelamin
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 */
class DataPasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_data_pasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_pasien', 'alamat', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir'], 'required'],
            [['alamat'], 'string'],
            [['tanggal_lahir'], 'safe'],
            [['nama_pasien'], 'string', 'max' => 128],
            [['jenis_kelamin'], 'string', 'max' => 1],
            [['tempat_lahir'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_pasien' => 'Kode Pasien',
            'nama_pasien' => 'Nama Pasien',
            'alamat' => 'Alamat',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
        ];
    }

    public function getGender()
    {
        return $this->jenis_kelamin == 1 ? 'Perempuan' : 'Laki-laki';
    }
}
