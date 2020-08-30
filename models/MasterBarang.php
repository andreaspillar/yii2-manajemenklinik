<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_master_barang".
 *
 * @property int $id_barang
 * @property string $nama_barang
 * @property string $produsen
 * @property float $harga
 * @property string $satuan
 * @property int $stok_barang
 *
 * @property TblResepDokter[] $tblResepDokters
 */
class MasterBarang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_master_barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_barang', 'produsen', 'harga', 'satuan', 'stok_barang'], 'required'],
            [['harga'], 'number'],
            [['stok_barang'], 'integer'],
            [['nama_barang', 'produsen'], 'string', 'max' => 64],
            [['satuan'], 'string', 'max' => 8],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_barang' => 'Id Barang',
            'nama_barang' => 'Nama Barang',
            'produsen' => 'Produsen',
            'harga' => 'Harga',
            'satuan' => 'Satuan',
            'stok_barang' => 'Stok Barang',
        ];
    }

    /**
     * Gets query for [[TblResepDokters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblResepDokters()
    {
        return $this->hasMany(ResepDokter::className(), ['id_barang' => 'id_barang']);
    }
}
