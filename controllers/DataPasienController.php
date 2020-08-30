<?php

namespace app\controllers;

use Yii;
use app\models\DataPasien;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DataPasienController extends Controller
{
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

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => DataPasien::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $cekcount = DataPasien::find()->count();
        if ($cekcount == 0){
            $model = new DataPasien();
            $model->kode_pasien = 'AH-1';
            $model->load(Yii::$app->request->post());
            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->kode_pasien]);
            }
        }
        else{
            $getLastKode = DataPasien::find()->orderBy(['kode_pasien' => SORT_DESC])->one();
            $split_kode = explode('-', $getLastKode->kode_pasien);
            $to_INT = intval($split_kode[1]);
            $plus_one = $to_INT + 1;
            $array_kode = array('AH',$plus_one);
            $join_kode = join('-',$array_kode);
            $model = new DataPasien();
            $model->kode_pasien = $join_kode;
            $model->load(Yii::$app->request->post());
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->kode_pasien]);
            }
        } 

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kode_pasien]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = DataPasien::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
