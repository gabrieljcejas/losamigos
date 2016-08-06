<?php

namespace app\controllers;

use app\models\Productos;
use app\models\Clientes;
use app\models\Ventas;
use app\models\Egresos;
use app\models\Turno;
use app\models\VentasDetalle;
use Yii;
use mPDF;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;


/**
 * BUSCO EL TURNO
 */
$turno = Turno::find()->orderBy(['id' => SORT_DESC])->one();
session_start();
$_SESSION["turno"] = $turno->id;
$_SESSION["caja"] = $turno->caja_inicial;
/**
 * VentasController implements the CRUD actions for Ventas model.
 */
class VentasController extends Controller {
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

	
	public function actionIndex() {

		$model = new Ventas();		

		if ($model->load(Yii::$app->request->post()) ) {
			
			$post = Yii::$app->request->post();			

			// guardo fecha actual con hora
			date_default_timezone_set('America/Buenos_Aires');						
			$date = date('Y-m-d h:i:s a', time());
			$model->fecha = $date;			
			
			//turno recibido de session
			$model->turno_id = $_SESSION["turno"];

			// si es consumidor no queda como pendiente, si no que pasa a historial ventas
			if ($model->cliente_id == 1){
				$model->entregado = 1;
			}
			
			// si seleciona envio o retira
			if ($post['envio']==1){
				$model->envio_domicilio = 1;
				$model->retira = 0;
			}else{
				$model->envio_domicilio = 0;
				$model->retira = 1;
			}
			
			if (!$model->save()) {
				throw new \yii\web\HttpException(400, 'Error al guardar la venta');
			}
			else{			
				//una ves que guardo en tabla ventas 
				// recorro la tabla de ventas para grabar en ventadetalles
				foreach ($post['cantidad'] as $key => $value) {					
					$ventadetalle = new VentasDetalle();
					$ventadetalle->venta_id = $model->id;
					$ventadetalle->cant = $post['cantidad'][$key];
					$ventadetalle->prod_id = $post['producto_id'][$key];					
					$ventadetalle->precio = $post['precio_venta'][$key];					
					if (!$ventadetalle->save()) {						
						throw new \yii\web\HttpException(400, 'Error al guardar ventas detalle');
					}
					else{
						// si guardo descuento del stock
						$producto_id = $post['producto_id'][$key];
						$cantidad = $post['cantidad'][$key];
						
						/** 
						*** DESCUENTO DE LA TABLA TURNO LA CANTIDAD DE SOBRA
						**/
						$turno = Turno::find()->where(['id'=>$_SESSION["turno"]])->one();
						//resto del stock y del turno
						$this->restarStock($producto_id,$turno,$cantidad);
					}					
				}
				
			}
			return $this->redirect(['index']);
		} 

		$turno = Turno::find()->where(['id'=>$_SESSION["turno"]])->one();
		$queda = $turno->sobra_pollo;		
		// Historial Ventas 
		$listventas = Ventas::find()
			->where(['entregado'=>1])
			->andWhere(['turno_id'=>$turno->id])		
			->orderBy('id DESC');
		$historialventas = new ActiveDataProvider([
          'query' => $listventas,
        ]);

		
		// Pedidos Pendientes
		$listpedidos = Ventas::find()->where(['entregado'=>null])->andWhere(['turno_id'=>$turno->id])->orderBy('id');
		$pedidospendientes = new ActiveDataProvider([
          'query' => $listpedidos,
        ]);        		

		/**
		**+++++++++++++CALCULOS ++++++++++++++++++++++
		**/
		$productos = Productos::find()->where(['>','id',0])->all();
				
		$totalventas = $model->CalcularTotalVentas($turno);
		
		$totalegresos = $model->CalcularTotalEgresos($turno);
		
		$totalproductosvendidos = $model->CalcularCantidadProductosVendidos($turno);
		
		/**************************************************************************/
		

		//traigo todos los dni del cliente		
		$list_clientes = Clientes::find()->orderBy('dni')->all();	

		// agrego al listado el nombre 
	 	foreach ($list_clientes as $c) {
            $clientes[$c['id']] = $c['nombre'] . "  -  ". $c['domicilio'] ;
        }		

        return $this->render('index', [
			'productos' => $productos,
			'clientes' => $clientes,
			'model' => $model,
			'historialventas'=>$historialventas,
			'pedidospendientes'=>$pedidospendientes,
			'queda'=>$queda,
			'totalventas'=>$totalventas,
			'totalegresos'=>$totalegresos,
			'totalproductosvendidos'=>$totalproductosvendidos,
		]);	
			
					
	}

	private function restarStock ($producto_id,$turno,$cantidad){

		$modelp = Productos::find()->where(['id'=>$producto_id])->one();

		switch ($producto_id) {

			case '1': // PROMO								
				$turno->sobra_pollo = $turno->sobra_pollo - $cantidad;
				$modelp->stock = $modelp->stock - $cantidad;
				if (!$turno->save() && $modelp->save()) {
					throw new \yii\web\HttpException(400, 'Error al descontar del la tabla turno cantidad pollo');
				}	
			break;

			case '2': // POLLO								
				$turno->sobra_pollo = $turno->sobra_pollo - $cantidad;
				$modelp->stock = $modelp->stock - $cantidad;								
				if (!$turno->save() && $modelp->save()) {
					throw new \yii\web\HttpException(400, 'Error al descontar del la tabla cantidad pollo');
				}	
			break;

			case '3': // MEDIA POLLO
				$turno->sobra_pollo = $turno->sobra_pollo - ($cantidad*0.5);
				$modelp->stock = $modelp->stock - ($cantidad*0.5);								
				if (!$turno->save() && $modelp->save()) {
					throw new \yii\web\HttpException(400, 'Error al descontar del la tabla cantidad pollo');
				}	
			break;
			
			
			default:											
				/*$modelp->stock = $modelp->stock - $cantidad;
				if (!$modelp->save()) {
					throw new \yii\web\HttpException(400, 'Error al descontar en la tabla producto id' );
				}*/	
			break;
		}

		return ;
	}

	/**
	**************************** C  O  N  S  U  L  T A S  ***************
	**/

	public function actionConsultaMovimientosCaja() {


		if (Yii::$app->request->post()) {

			$post = Yii::$app->request->post();

			$fecha_desde = date('Y-m-d', strtotime($post['fecha_desde']));
			$fecha_hasta = date('Y-m-d', strtotime($post['fecha_hasta']));

			// sumo un dia a fecha hasta por que no me trae los datos hasta la ultima fecha, ej: si fecha_desde es 10-04-2016 y fecha_hasta 14-04-2016 me trae hasta el 13-04-2016, la ultima fecha no me trae y no se por que mierda. SOLO PASA EN VENTAS seguro es por que el campo es datetime
			$h = $fecha_hasta;
		 	$fields = explode('-', $h);
		 	$hasta= $fields[0].'-'.$fields[1].'-'.($fields[2]+1);

		 	
			$ventas = Ventas::find()->where(['>=', 'fecha', $fecha_desde])->andWhere(['<=', 'fecha', $hasta])->orderBy("fecha")->all();

			$egresos = Egresos::find()->where(['>=', 'fecha', $fecha_desde])->andWhere(['<=', 'fecha', $fecha_hasta])->orderBy("fecha")->all();;

			$modelVentas = new Ventas();
			$productos_vendidos = $modelVentas->ListCantProdVendidosPorFecha($fecha_desde,$hasta);		

			$mpdf = new mPDF('utf-8', 'A4');
			$mpdf->WriteHTML($this->renderPartial('imprimir_movimientos_caja', [
				'ventas' => $ventas,
				'egresos' => $egresos,
				'fecha_desde' => $fecha_desde,
				'fecha_hasta' => $fecha_hasta,
				'productos_vendidos' => $productos_vendidos
			]));
			$mpdf->Output();
			exit;
			
		}

		$titulo = "Consulta Movimientos de Caja";
		return $this->render('_consulta_entre_fechas',[
				'titulo'=>$titulo,
			]);


	}



	public function actionConsultaEgresos() {


		if (Yii::$app->request->post()) {

			$post = Yii::$app->request->post();

			$fecha_desde = date('Y-m-d', strtotime($post['fecha_desde']));

			$fecha_hasta = date('Y-m-d', strtotime($post['fecha_hasta']));

			$egresos = Egresos::find()->where(['>=', 'fecha', $fecha_desde])->andWhere(['<=', 'fecha', $fecha_hasta])->orderBy("fecha")->all();

			
			$mpdf = new mPDF('utf-8', 'A4');
			$mpdf->WriteHTML($this->renderPartial('imprimir_egresos', [
				'ventas' => $ventas,
				'egresos' => $egresos,
				'fecha_desde' => $fecha_desde,
				'fecha_hasta' => $fecha_hasta,
			]));
			$mpdf->Output();
			exit;
			
		}

		$titulo = "Consulta Egresos";
		return $this->render('_consulta_entre_fechas',[
				'titulo'=>$titulo,
			]);


	}

	public function actionConsultaVentas() {


		if (Yii::$app->request->post()) {

			$post = Yii::$app->request->post();

			$fecha_desde = date('Y-m-d', strtotime($post['fecha_desde']));
			$fecha_hasta = date('Y-m-d', strtotime($post['fecha_hasta']));

			// sumo un dia a fecha hasta por que no me trae los datos hasta la ultima fecha, ej: si fecha_desde es 10-04-2016 y fecha_hasta 14-04-2016 me trae hasta el 13-04-2016, la ultima fecha no me trae y no se por que mierda. SOLO PASA EN VENTAS seguro es por que el campo es datetime
			$h = $fecha_hasta;
		 	$fields = explode('-', $h);
		 	$hasta= $fields[0].'-'.$fields[1].'-'.($fields[2]+1);

		 	
			$ventas = Ventas::find()->where(['>=', 'fecha', $fecha_desde])->andWhere(['<=', 'fecha', $hasta])->orderBy("fecha")->all();

			
			$mpdf = new mPDF('utf-8', 'A4');
			$mpdf->WriteHTML($this->renderPartial('imprimir_ventas', [
				'ventas' => $ventas,
				'egresos' => $egresos,
				'fecha_desde' => $fecha_desde,
				'fecha_hasta' => $fecha_hasta,
			]));
			$mpdf->Output();
			exit;
			
		}
		$titulo = "Consulta Ventas";
		return $this->render('_consulta_entre_fechas',[
				'titulo'=>$titulo,
			]);


	}

	public function actionConsultaTotalProdVend() {


		if (Yii::$app->request->post()) {

			$post = Yii::$app->request->post();

			$fecha_desde = date('Y-m-d', strtotime($post['fecha_desde']));			
			$fecha_hasta = date('Y-m-d', strtotime($post['fecha_hasta']));
			
			$h = $fecha_hasta;		 	
		 	$fields = explode('-', $h);		 	
		 	$hasta = $fields[0].'-'.$fields[1].'-'.($fields[2]+1);

		 	
			$ventas = new Ventas();
			$query = $ventas->ListCantProdVendidosPorFecha($fecha_desde,$hasta);			
			
			$mpdf = new mPDF('utf-8', 'A4');
			
			$mpdf->WriteHTML($this->renderPartial('imprimir_cantidad_productos_vendidos', [
				'query' => $query,				
				'fecha_desde' => $fecha_desde,
				'fecha_hasta' => $fecha_hasta,
			]));
			
			$mpdf->Output();
			
			exit;
			
		}
		
		$titulo = "Consulta Productos Vendidos";
		
		return $this->render('_consulta_entre_fechas',[
				'titulo'=>$titulo,
			]);


	}


	public function actionPedidoListo() {
		
		$post = Yii::$app->request->post();
		
		$id = $post['id'];

		$model = $this->findModel($id);
		
		$model->entregado = 1;
		
		if (!$model->save()) {
			throw new \yii\web\HttpException(400, 'Error al guardar listo entregado');
		}		
		return;
	}

	public function actionPedidoCancela() {
		
		$post = Yii::$app->request->get();
		
		$id = $post['id'];

		try { 
			
			$this->findModel($id)->delete();						
			
			VentasDetalle::deleteAll('venta_id = :id',[':id' => $id]);

		} catch (Exception $e) {    	
    		
    		echo 'Error al Borrar Pedido Pendiente: ',  $e->getMessage(), "\n";

		}

		return $this->redirect(['index']);
	}


	public function actionView($id) {
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	
	public function actionUpdate($id) {
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	
	public function actionDelete($id) {
		
		$this->findModel($id)->delete();
		return $this->redirect(['index']);
		
	}


	public function actionGetInfoCliente() {
		
		$post = Yii::$app->request->post();
		$id = $post['id'];
		$query = Clientes::find()->where(['id' => $id])->one();
		
		$clientes = array();		
		$clientes[] = array('domicilio' => $query->domicilio, 'telefono' => $query->telefono);
		
		
		//var_dump($clientes);die;
		echo json_encode($clientes);

	}

	/**
	 * Finds the Ventas model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Ventas the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Ventas::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
