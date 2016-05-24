<div><h1>Egresos</h1><label>Fecha desde: <?=date("d-m-Y", strtotime($fecha_desde)) . " hasta " . date("d-m-Y", strtotime($fecha_hasta))?></label></div>
<hr>

<br><br>

<table border="1" width="700">

<tr>
	<th>Fecha</th>
	<th>Proveedor</th>
	<th>Detalle</th>
	<th>Cantidad</th>
	<th>Precio Un.</th>
	<th>Total</th>
</tr>

<?php $egresosTotal=0; ?>	
		
<?php foreach ($egresos as $e) {?>
			
		<?php $egresosTotal = $e->total + $egresosTotal; ?>		
		
		<tr>
			<td align="center"><?=date("d-m-Y", strtotime($e->fecha))?></td>
			<td align="center"><?=$e->proveedores->nombre ?></td>
			<?php if ($e->prod_id == ""){ ?> 
				<td align="center"><?=$e->otro ?></td>
			<?php } else { ?>
				<td align="center"><?=$e->productos->nombre ?></td>
			<?php } ?>

			<td align="center"><?=$e->cantidad?></td>					
			<td align="center"><?=$e->precio?></td>					
			<td align="center"><?=$e->total?></td>					
		</tr>	
		
	<?php } ?>			

</table>
<br>

<p><strong>EGRESOS: $<?=$egresosTotal?></strong></p>


