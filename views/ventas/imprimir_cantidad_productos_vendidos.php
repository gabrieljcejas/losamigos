<div><h1>Cantidad de Productos Vendidos</h1><label>Fecha desde: <?=date("d-m-Y", strtotime($fecha_desde)) . " hasta " . date("d-m-Y", strtotime($fecha_hasta))?></label></div>
<hr>

<br><br>

<!--
 ---- CANTIDAD DE PRODUCTOS VENDIDOS 
 -->
<h3>Cantidad de Productos Vendidos</h3>     

<table class="table" >
    <?php if (isset($query)){ ?>
        <?php foreach ($query as $key => $value) { ?>
        
            <tr>
                <td><?= strtoupper($key) ?></td>
                <td><?=  $value ?></td>
            </tr>        
            
        <?php } ?>
    <?php } ?>
</table>                
