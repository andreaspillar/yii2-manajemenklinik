<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LaporanPeriksa;

/**
 * LaporanPeriksaSearch represents the model behind the search form of `app\models\LaporanPeriksa`.
 */
class LaporanPeriksaSearch extends LaporanPeriksa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_laporan', 'no_kunjungan', 'diagnosa', 'tindakan'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $searchDokter = StaffDokter::find()->where(['id_user' => $params])->all();
        $searchKunjungan = JadwalKunjungan::find()->where(['nomor_induk_karyawan' => $searchDokter])->all();
        $query = LaporanPeriksa::find()->where(['no_kunjungan' => $searchKunjungan]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'kode_laporan', $this->kode_laporan])
            ->andFilterWhere(['like', 'no_kunjungan', $this->no_kunjungan])
            ->andFilterWhere(['like', 'diagnosa', $this->diagnosa])
            ->andFilterWhere(['like', 'tindakan', $this->tindakan]);

        return $dataProvider;
    }
}
