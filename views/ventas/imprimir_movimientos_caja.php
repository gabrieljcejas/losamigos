<div><h1>Movimientos de Caja</h1><label>Fecha desde: <?=date("d-m-Y", strtotime($fecha_desde)) . " hasta " . date("d-m-Y", strtotime($fecha_hasta))?></label></div>
<hr>

<br><br><br>

<table border="1" width="700">

<tr>
	<th>Fecha</th>
	<th>Concepto</th>
	<th>Debe</th>
	<th>Haber</th>
	<th>Saldo</th>
</tr>

<?php 
	$i=0;
	$saldo=0;	
	$ventasTotal=0;
	$egresosTotal=0;
 ?>	

<?php foreach ($ventas as $v) { ?>
	
	<?php if ($i == 0){ 
		$fecha=substr($v->fecha,0,10);		
		$i=$i+1; 
	}?>
	<?php 

	$saldo= $v->total + $saldo; 
	$ventasTotal= $v->total + $ventasTotal;

	?>
	<tr>
		<td align="center"><?=date("d-m-Y", strtotime($v->fecha))?></td>
		<td align="center"><?=$v->clientes->nombre?></td>
		<td align="center"><?=$v->total?></td>
		<td align="center"><?="-"?></td>					
		<td align="center"><?=$saldo ?></td>					
	</tr>
	
	<!--<?php if (substr($v->fecha,0,10) != $fecha){ ?> -->
		

	<!--<?php } ?>	-->
	
	<?php $fecha=substr($v->fecha,0,10); ?>
	
	
<?php } ?>


		<?php foreach ($egresos as $e) {?>
			
			<?php $egresosTotal = $e->total + $egresosTotal; ?>

			<?php if ($fecha == $e->fecha){ ?>	
				
				<?php $saldo = $saldo - $e->total; ?>

				<tr>
					<td align="center"><?=date("d-m-Y", strtotime($e->fecha))?></td>
					<?php if ($e->prod_id == ""){ ?> 
						<td align="center"><?=$e->otro ?></td>
					<?php } else { ?>
						<td align="center"><?=$e->productos->nombre ?></td>
					<?php } ?>
					<td align="center"><?="-"?></td>					
					<td align="center"><?=$e->total?></td>					
					<td align="center"><?=$saldo ?></td>					
				</tr>	
				
			<?php } ?>	

		<?php } ?>	




</table>

<br>

<p><strong>VENTAS: $<?=$ventasTotal?></strong></p>
<p><strong>EGRESOS: $<?=$egresosTotal?></strong></p>
<p><strong>SALDO: $<?=$saldo?></strong></p>

