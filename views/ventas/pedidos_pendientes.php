<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\Controllers\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedidos Pendientes';

?>

<div>

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?php Pjax::begin(['id' => 'grd_pedidos_pendientes', 'timeout' => false]); ?>     
    
    <?= GridView::widget([
        'dataProvider' => $pedidospendientes,
        
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
            [
                'attribute' => 'envio_domicilio',
                'value' => function ($model) {
                    if ($model->envio_domicilio == 1){
                        $envio = "SI";
                    }else{
                        $envio = "";
                    }
                    return $envio;
                },
            ],   
            [
                'attribute' => 'retira',
                'value' => function ($model) {
                    if ($model->retira == 1){
                        $retira = "SI";
                    }else{
                        $retira = "";
                    }
                    return $retira;
                },
            ],   
            'hora_encargue',            
            'obs',           
 
               [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{listo} {cancelar}',
                'buttons' => [             
                    
                    'listo' => function ($url, $model) {
                        return html::button('', ['class' => ' btn btn-success glyphicon glyphicon-ok', 'name' => 'listo', 'value' => $model->id]);                     
                    },
                    'cancelar' => function ($url, $model) {
                        return Html::a('<span class="btn btn-default glyphicon glyphicon-remove"></span>', $url, [
                            'title' => Yii::t('app', 'Eliminar'),
                            'data-confirm' => Yii::t('yii', 'Seguro que desea eliminar pedido?'),
                            //'data-method' => 'post',
                            'name'=>'cancelar',
                            'value' => $model->id,

                        ]);
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index){                              
                    if ($action === 'listo') {
                        $url = Url::to(['ventas/pedido-listo', 'id' => $model->id]);
                        return $url;
                    }   
                    if ($action === 'cancelar') {
                        $url = Url::to(['ventas/pedido-cancela', 'id' => $model->id]);
                        return $url;
                    } 

                },
              ],          
        ],
    ]); ?>
    
</div>

<script type="text/javascript" src="<?=Yii::$app->request->baseUrl?>/js/jquery.min.js"></script>

<script>
    
    $("button[name='listo']").click(function () {
                               
            var id = $(this).attr('value');            
            
            $.ajax({
                type: "POST",
                url: "../web/index.php?r=ventas/pedido-listo",
                data: {id: id},                               
                success: function (data) {
                    $.pjax.reload({container: '#grd_pedidos_pendientes'});                    
                }
            });  
          
    });

    $("button[name='cancelar']").click(function () {
                               
            var id = $(this).attr('value');            
            
            $.ajax({
                type: "GET",
                url: "../web/index.php?r=ventas/pedido-cancela",
                data: {id: id},                               
                success: function (data) {
                    $.pjax.reload({container: '#grd_pedidos_pendientes'});                    
                }
            });  
          
    });

</script>
<?php Pjax::end();?>  