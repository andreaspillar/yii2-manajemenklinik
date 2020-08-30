<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_resep_dokter".
 *
 * @property string $kode_resep
 * @property string $kode_laporan
 * @property int $id_barang
 * @property int $jumlah_barang
 *
 * @property TblMasterBarang $barang
 * @property TblLapPemeriksaan $kodeLaporan
 */
class ResepDokter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_resep_dokter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_resep', 'kode_laporan', 'id_barang', 'jumlah_barang'], 'required'],
            [['id_barang', 'jumlah_barang'], 'integer'],
            [['kode_resep', 'kode_laporan'], 'string', 'max' => 128],
            [['kode_resep'], 'unique'],
            [['id_barang'], 'exist', 'skipOnError' => true, 'targetClass' => MasterBarang::className(), 'targetAttribute' => ['id_barang' => 'id_barang']],
            [['kode_laporan'], 'exist', 'skipOnError' => true, 'targetClass' => LaporanPeriksa::className(), 'targetAttribute' => ['kode_laporan' => 'kode_laporan']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_resep' => 'Kode Resep',
            'kode_laporan' => 'Kode Laporan',
            'id_barang' => 'Id Barang',
            'jumlah_barang' => 'Jumlah Barang',
        ];
    }

    /**
     * Gets query for [[Barang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBarang()
    {
        return $this->hasOne(MasterBarang::className(), ['id_barang' => 'id_barang']);
    }

    /**
     * Gets query for [[KodeLaporan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeriksa()
    {
        return $this->hasOne(LaporanPeriksa::className(), ['kode_laporan' => 'kode_laporan']);
    }
}
