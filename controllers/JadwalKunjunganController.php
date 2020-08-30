<?php

namespace app\controllers;

use Yii;
use app\models\JadwalKunjungan;
use app\models\DataPasien;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JadwalKunjunganController implements the CRUD actions for JadwalKunjungan model.
 */
class JadwalKunjunganController extends Controller
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
     * Lists all JadwalKunjungan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => JadwalKunjungan::find()       
        ,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionIndexDokterUser()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => JadwalKunjungan::find()->where(['status' => 0])       
        ,
        ]);

        return $this->render('index-dokter-user', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JadwalKunjungan model.
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
     * Creates a new JadwalKunjungan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $cekcount = JadwalKunjungan::find()->count();
        if ($cekcount == 0){
            $model = new JadwalKunjungan();
            $model->no_kunjungan = 'K-1';
            $model->load(Yii::$app->request->post());
            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->no_kunjungan]);
            }
        }
        else{
            $getLastKode = JadwalKunjungan::find()->orderBy(['no_kunjungan' => SORT_DESC])->one();
            $split_kode = explode('-', $getLastKode->no_kunjungan);
            $to_INT = intval($split_kode[1]);
            $plus_one = $to_INT + 1;
            $array_kode = array('K',$plus_one);
            $join_kode = join('-',$array_kode);
            $model = new JadwalKunjungan();
            $model->no_kunjungan = $join_kode;
            $model->load(Yii::$app->request->post());
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->no_kunjungan]);
            }
        } 

        return $this->render('create', [
            'model' => $model, 
        ]);
    }

    /**
     * Updates an existing JadwalKunjungan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->no_kunjungan]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JadwalKunjungan model.
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
     * Finds the JadwalKunjungan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return JadwalKunjungan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JadwalKunjungan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
