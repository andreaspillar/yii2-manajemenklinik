<?php

namespace app\controllers;

use Yii;
use app\models\LaporanPeriksa;
use app\models\JadwalKunjungan;
use app\models\ResepDokter;
use app\models\StaffDokter;
use app\models\LaporanPeriksaSearch;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * LaporanPeriksaController implements the CRUD actions for LaporanPeriksa model.
 */
class LaporanPeriksaController extends Controller
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
     * Lists all LaporanPeriksa models.
     * @return mixed
     */
    public function actionIndex()
    { 
        $searchModel = new LaporanPeriksaSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->search(Yii::$app->user->identity->id_user);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LaporanPeriksa model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $cekResep = ResepDokter::find()->where(['kode_laporan' => $id])->count();
        if($cekResep == 0){
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
        else{
            $dataProvider = new ActiveDataProvider([
                'query' => ResepDokter::find()->where(['kode_laporan' => $id])
            ,
            ]);
            // $reseps = ResepDokter::find()->where(['kode_laporan' => $id]);
            return $this->render('view-resep', [
                'model' => $this->findModel($id), 'resep' => $dataProvider,
            ]);
        }
    }

    /**
     * Creates a new LaporanPeriksa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $cekcount = LaporanPeriksa::find()->count();
        if ($cekcount == 0){
            $model = new LaporanPeriksa();
            $model->kode_laporan = 'C-1';
            $model->load(Yii::$app->request->post());
            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->kode_laporan]);
            }
        }
        else{
            $getLastKode = LaporanPeriksa::find()->orderBy(['kode_periksa' => SORT_DESC])->one();
            $split_kode = explode('-', $getLastKode->kode_periksa);
            $to_INT = intval($split_kode[1]);
            $plus_one = $to_INT + 1;
            $array_kode = array('C',$plus_one);
            $join_kode = join('-',$array_kode);
            $model = new LaporanPeriksa();
            $model->no_kunjungan = $join_kode;
            $model->load(Yii::$app->request->post());
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->kode_periksa]);
            }
        } 

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateById($id)
    {
        $cekcount = LaporanPeriksa::find()->count();
        if ($cekcount == 0){
            $model = new LaporanPeriksa();
            $model->kode_laporan = 'C-1';
            $model->no_kunjungan = $id;
            $model->load(Yii::$app->request->post());
            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->kode_laporan]);
            }
        }
        else{
            $getLastKode = LaporanPeriksa::find()->orderBy(['kode_laporan' => SORT_DESC])->one();
            $split_kode = explode('-', $getLastKode->kode_laporan);
            $to_INT = intval($split_kode[1]);
            $plus_one = $to_INT + 1;
            $array_kode = array('C',$plus_one);
            $join_kode = join('-',$array_kode);
            $model = new LaporanPeriksa();
            $model->kode_laporan = $join_kode;
            $model->no_kunjungan = $id;
            $model->load(Yii::$app->request->post());
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->kode_laporan]);
            }
        } 

        return $this->render('create-by-id', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LaporanPeriksa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kode_laporan]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LaporanPeriksa model.
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
     * Finds the LaporanPeriksa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LaporanPeriksa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LaporanPeriksa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
