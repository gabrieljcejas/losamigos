<?php

use yii\bootstrap\Tabs;
use yii\helpers\Html;

?>

<div class="venta-view">

<?= "<h1 align='right'>Pollos: <b>". $queda . "</b></h1>";?>



<?=
	Tabs::widget([
		'items' => [
			[
				'label' => 'Ventas',
				'content' => $this->render('ventas', ['model' => $model, 'form' => $form, 'productos' => $productos,'clientes'=>$clientes,'queda'=>$queda,]),
				//IMPORTANTE SI NO ESTA BIEN EL HTML, NO RENDERISA BIEN, ES DECIR, NO CAMBIA EL TAB
				'active' => true,
			],
			[
				'label' => 'Pedidos Pendientes',			
				'content' => $this->render('pedidos_pendientes', ['pedidospendientes' => $pedidospendientes]),

			],
			[
				'label' => 'Historial Ventas',
				'content' => $this->render('historial_ventas', ['historialventas'=>$historialventas,'totalventas'=>$totalventas,'totalegresos'=>$totalegresos,'totalproductosvendidos'=>$totalproductosvendidos]),
			],
		],

	]);
?>

</div>
<script type="text/javascript" src="<?=Yii::$app->request->baseUrl?>/js/jquery.min.js"></script>
