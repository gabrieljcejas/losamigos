<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\Controllers\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Historial de Ventas';
 session_start();
?>
<div class="Historial-Ventas">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php Pjax::begin(['id' => 'grd_historial_ventas', 'timeout' => false]); ?>  
    
    <?= GridView::widget([
        'dataProvider' => $historialventas,
        
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute'=>'fecha',
                'value'=> function ($model) {
                    return date("d-m-Y H:i:s",strtotime($model->fecha));
                }
            ],
            'clientes.nombre',
            'clientes.domicilio',                        
            [
                'attribute' => 'Productos',
                'value' => function ($model) {
                    return $model->getProductosConcatenados($model->id);
                },
            ],  
            'total',
            'paga',
            'vuelto',
            'obs',           

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<br>

<?php $cajafinal = $_SESSION["caja"] + $totalventas - $totalegresos ?>

<!--
 ---- CANTIDAD DE PRODUCTOS VENDIDOS 
 -->     
<div class="row">
    
    <div class="col-md-3">
        <a href="#cantidadproductos" class="btn btn-default" data-toggle="collapse">Cantidad de Productos Vendidos <span class="glyphicon glyphicon-triangle-bottom"></span></a>
            <div id="cantidadproductos" class="collapse">
                <table class="table table-striped" >
                <?php if (isset($totalproductosvendidos)){ ?>
                    <?php foreach ($totalproductosvendidos as $key => $value) { ?>
                    
                        <tr>
                            <td><strong><?= strtoupper($key) ?></strong></td>
                            <td><strong><?=  $value ?></strong></td>
                        </tr>        
                        
                    <?php } ?>
                <?php } ?>
                </table>    
            </div>
    </div>

<!--
 ---- RESUMEN
 --> 

    <div class="col-md-4">
        <a href="#resumen" class="btn btn-default" data-toggle="collapse">Resumen <span class="glyphicon glyphicon-triangle-bottom"></span></a><br>
            <div id="resumen" class="collapse">
                <table class="table table-striped" >
                    
                    <tr>
                        <td><strong>CAJA INICIAL:</strong></td>
                        <td><strong>$<?=$_SESSION["caja"]?></strong></td>
                    </tr>
                    
                    <tr>
                        <td><strong>VENTAS: </strong></td>
                        <td><strong>$<?= $totalventas ?></strong></td>
                    </tr>
                    
                    <tr>
                        <td><strong>COMPRAS:</strong></td>
                        <td><strong>$<?= $totalegresos ?></strong></td>
                    </tr>

                    <tr>
                        <td><strong>CAJA FINAL:</strong></td>
                        <td><strong>$<?= $cajafinal ?></strong></td>
                    </tr>

                </table>
            </div>    
    </div>    
</div>


<?php Pjax::end()?>

