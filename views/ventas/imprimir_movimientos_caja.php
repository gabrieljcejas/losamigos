<div><h1>Movimientos de Caja</h1><label>Fecha desde: <?=date("d-m-Y", strtotime($fecha_desde)) . " hasta " . date("d-m-Y", strtotime($fecha_hasta))?></label></div>
<hr>

<br><br><br>

<table border="1">

<tr>
	<th>Fecha</th>
	<th>Concepto</th>
	<th>Debe</th>
	<th>Haber</th>
	<th>Saldo</th>
</tr>

<!--<?php foreach ($ventas as $v) {?>

	
<?php } ?>-->

</table>

<br>

<p><strong>SALDO: $<?=$saldo?></strong></p>

