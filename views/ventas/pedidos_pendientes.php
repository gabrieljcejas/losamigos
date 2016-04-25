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
            'fecha',
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
<<<<<<< HEAD
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
=======
            'envio_domicilio',
            'retira', 
>>>>>>> origin/master
            'hora_encargue',            
            'obs',           
 
               [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{listo} {cancela}',
                'buttons' => [             
                    
                    'listo' => function ($url, $model) {
                        return html::button(' Listo', ['class' => ' btn btn-success glyphicon glyphicon-ok', 'name' => 'listo', 'value' => $model->id]);                     
                    },
<<<<<<< HEAD
                    /*'cancela' => function ($url, $model) {
=======
                    'cancela' => function ($url, $model) {
>>>>>>> origin/master
                        return Html::a('<span class="btn btn-default glyphicon glyphicon-remove"></span>', $url, [
                            'title' => Yii::t('app', 'Eliminar'),
                            'data-confirm' => Yii::t('yii', 'Seguro que desea eliminar pedido?'),
                            //'data-method' => 'post',
                            //'name'=>'cancelar',
                            //value' => $model->id,

                        ]);
<<<<<<< HEAD
                    },*/
=======
                    },
>>>>>>> origin/master
                ],
                'urlCreator' => function ($action, $model, $key, $index){                              
                    if ($action === 'listo') {
                        $url = Url::to(['ventas/pedido-listo', 'id' => $model->id]);
                        return $url;
                    }   
<<<<<<< HEAD
                    /*if ($action === 'cancela') {
                        $url = Url::to(['ventas/pedido-cancela', 'id' => $model->id]);
                        return $url;
                    } */
=======
                    if ($action === 'cancela') {
                        $url = Url::to(['ventas/pedido-cancela', 'id' => $model->id]);
                        return $url;
                    } 
>>>>>>> origin/master

                },
              ],          
        ],
    ]); ?>
    
</div>

<script type="text/javascript" src="<?=Yii::$app->request->baseUrl?>/js/jquery.min.js"></script>

<script>
    
    $("button[name='listo']").click(function () {
<<<<<<< HEAD
                               
=======
          
          //if (confirm('Seguro que desea Eliminar?')) {
           
>>>>>>> origin/master
            var id = $(this).attr('value');            
            
            $.ajax({
                type: "POST",
                url: "../web/index.php?r=ventas/pedido-listo",
                data: {id: id},                               
                success: function (data) {
<<<<<<< HEAD
                    $.pjax.reload({container: '#grd_pedidos_pendientes'});                    
                }
            });  
          
    });

=======
                    $.pjax.reload({container: '#grd_pedidos_pendientes'});
                    // $.pjax.reload({container: '#grd_historial_ventas'});                      
                }
            });  

          //}
    });




>>>>>>> origin/master
</script>
<?php Pjax::end();?>  