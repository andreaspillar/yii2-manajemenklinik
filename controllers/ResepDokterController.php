<?php

namespace app\controllers;

use Yii;
use app\models\ResepDokter;
use app\models\JadwalKunjungan;
use app\models\LaporanPeriksa;
use app\models\StaffDokter;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResepDokterController implements the CRUD actions for ResepDokter model.
 */
class ResepDokterController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ResepDokter models.
     * @return mixed
     */
    public function actionIndex()
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
    
    public function actionIndexApoteker()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ResepDokter::find(),
        ]);

        return $this->render('index-apoteker', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ResepDokter model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ResepDokter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ResepDokter();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kode_resep]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateById($id)
    {
        $cekcount = ResepDokter::find()->count();
        if ($cekcount == 0){
            $model = new ResepDokter();
            $model->kode_resep = 'R-1';
            $model->kode_laporan = $id;
            $model->load(Yii::$app->request->post());
            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->kode_resep]);
            }
        }
        else{
            $getLastKode = ResepDokter::find()->orderBy(['kode_resep' => SORT_DESC])->one();
            $split_kode = explode('-', $getLastKode->kode_resep);
            $to_INT = intval($split_kode[1]);
            $plus_one = $to_INT + 1;
            $array_kode = array('R',$plus_one);
            $join_kode = join('-',$array_kode);
            $model = new ResepDokter();
            $model->kode_resep = $join_kode;
            $model->kode_laporan = $id;
            $model->load(Yii::$app->request->post());
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->kode_resep]);
            }
        } 

        return $this->render('create-by-id', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ResepDokter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kode_resep]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ResepDokter model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ResepDokter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ResepDokter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ResepDokter::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
