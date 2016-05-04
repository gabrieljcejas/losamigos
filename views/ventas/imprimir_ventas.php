<div><h1>Ventas</h1><label>Fecha desde: <?=date("d-m-Y", strtotime($fecha_desde)) . " hasta " . date("d-m-Y", strtotime($fecha_hasta))?></label></div>
<hr>

<br><br>

<table border="1" width="700">

<tr>
	<th>Fecha</th>
	<th>Concepto</th>
	<th>Total</th>
</tr>

<?php $ventasTotal=0; ?>	
		
<?php foreach ($ventas as $v) {?>
			
		<?php $ventasTotal = $v->total + $ventasTotal; ?>		
		
		<tr>
			<td align="center"><?=date("d-m-Y", strtotime($v->fecha))?></td>
			<td align="center"><?=$v->clientes->nombre?></td>
			<td align="center"><?=$v->total?></td>			
		</tr>
		
<?php } ?>			

</table>
<br>

<p><strong>VENTAS: $<?=$ventasTotal?></strong></p>


