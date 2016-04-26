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

<?php $i=0; ?>	

<?php foreach ($ventas as $v) { ?>
	
	<?php if ($i == 0){ 
		$turnoid=$v->turno_id;
		$i=$i+1; 
	}?>

	<tr>
		<td align="center"><?=date("d-m-Y", strtotime($v->fecha))?></td>
		<td align="center"><?=$v->clientes->nombre?></td>
		<td align="center"><?=$v->total?></td>
		<td align="center"><?="-"?></td>					
		<td align="center"><?="-"?></td>					
	</tr>

	<?php if ($v->turno_id != $turnoid){ ?>	
		
		<?php foreach ($egresos as $e) {?>
			
			<?php if ($turnoid == $e->turno_id){ ?>	
				
				<tr>
					<td align="center"><?=date("d-m-Y", strtotime($e->fecha))?></td>
					<td align="center"><?=$e->otro?></td>
					<td align="center"><?="-"?></td>					
					<td align="center"><?=$e->total?></td>					
					<td align="center"><?="-"?></td>					
				</tr>	

			<?php } ?>	

		<?php } ?>	

	<?php } ?>	

	<?php $turnoid = $v->turno_id;?>
	
<?php } ?>

<?php foreach ($egresos as $e) {?>
			
	<?php if ($turnoid == $e->turno_id){ ?>	
		<tr>
			<td align="center"><?=date("d-m-Y", strtotime($e->fecha))?></td>
			<td align="center"><?=$e->otro?></td>
			<td align="center"><?="-"?></td>					
			<td align="center"><?=$e->total?></td>					
			<td align="center"><?="-"?></td>					
		</tr>	
	<?php } ?>	

<?php } ?>	

</table>

<br>

<p><strong>SALDO: $<?=$saldo?></strong></p>

