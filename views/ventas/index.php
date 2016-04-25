<?php

use yii\bootstrap\Tabs;

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
<<<<<<< HEAD
			'content' => $this->render('historial_ventas', ['historialventas'=>$historialventas,'totalventas'=>$totalventas,'totalegresos'=>$totalegresos,'totalproductosvendidos'=>$totalproductosvendidos]),
=======
			'content' => $this->render('historial_ventas', ['historialventas'=>$historialventas,'totalventas'=>$totalventas,'totalegresos'=>$totalegresos]),
>>>>>>> origin/master
		],
	],

]);
?>

</div>
<script type="text/javascript" src="<?=Yii::$app->request->baseUrl?>/js/jquery.min.js"></script>
