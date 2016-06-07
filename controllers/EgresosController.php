<?php

namespace app\controllers;

use Yii;
use app\models\Egresos;
use app\models\Productos;
use app\models\Proveedores;
use app\models\Turno;
use app\models\EgresosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EgresosController implements the CRUD actions for Egresos model.
 */
class EgresosController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Egresos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EgresosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Egresos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Egresos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Egresos();

        if ($model->load(Yii::$app->request->post())) {
           
            $turno = Turno::find()->orderBy(['id' => SORT_DESC])->one();                        
            
            $model->fecha = date('Y-m-d',strtotime($model->fecha));            

            $model->turno_id = $turno->id;
            
            // si selecciona un producto
            if ($model->prod_id != ""){
                //busco el producto por id
                $modelproductos = Productos::find()->where(['id'=>$model->prod_id])->one();
                //sumo al campo stock del producto
                $modelproductos->stock = $modelproductos->stock + $model->cantidad;
                //guardo
                $modelproductos->save();

            }

            if (!$model->save()) {

                throw new \yii\web\HttpException(400, 'Error al guardar');
            }

            return $this->redirect(['create']);
        } else {

            $listproductos = Productos::find()->all();

            foreach ($listproductos as $p) {
                $productos[$p['id']] = $p['nombre'];
            }   

            // paso fecha actual
            date_default_timezone_set('America/Buenos_Aires');
            $model->fecha = date('d-m-Y',time());

            //proveedores
            $listproveedores = Proveedores::find()->all(); 
            
            foreach ($listproveedores as $pr) {
                $proveedores[$pr['id']] = $pr['nombre'];
            } 
            


            return $this->render('create', [
                'model' => $model,
                'productos'=>$productos,
                'proveedores'=> $proveedores,
            ]);
        }
    }

    /**
     * Updates an existing Egresos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
        
            $model->fecha = date('Y-m-d',strtotime($model->fecha));
            
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Egresos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Egresos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Egresos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Egresos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
