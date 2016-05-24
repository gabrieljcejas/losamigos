<?php
session_start();
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel app\controllers\VentasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
//$this->params['breadcrumbs'][] = "Ventas";
//echo "session ". $_SESSION['turno'];
?>
<div class="ventas-index">

    <?php $form = ActiveForm::begin(); ?>
    <!--<h1><?=Html::encode($this->title)?></h1><br><br><br>-->
    
    <div class="row">

        <!-- COLUMNA IZQUIERDA -->
        <div class="col-md-6"><br>

            <!-- Recorro todos los productos -->
            <?php foreach ($productos as $p) {?>

                <button type="button" class="btn btn-default btn_producto" id="boton<?=$p->id?>" data-ide="<?=$p->id?>" data-nombre="<?=$p->nombre?>" data-precio_venta="<?=$p->precio_venta?>">
                    
                    <?php if ($p->id == 1){ ?>
                        <?=Html::img(yii::$app->urlManager->baseUrl . '/img/productos/' . $p->nombre_foto, ['width' => 300])?>
                    <?php } else{ ?>
                         <?=Html::img(yii::$app->urlManager->baseUrl . '/img/productos/' . $p->nombre_foto, ['width' => 80])?>
                    <?php }?>

                </button>

            <?php };?>

        </div>
        
        <!-- COLUMNA DERECHA -->
        <div class="col-md-6"><br>
            
            <!-- Clientes -->
            <div class="row">                                         
                
                <div class="col-md-10">
                    <?=$form->field($model, 'cliente_id')->widget(Select2::classname(), [
                        'data' => $clientes,                     
                        'options' => ['placeholder' => 'Buscar...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);?>
                </div>
                <div class="col-md-1"><br>
                    <?=html::button('', ['value'=>Url::to('index.php?r=clientes/create'),'class' => 'btn glyphicon glyphicon-plus', 'id' => 'agregarcliente'])?>  

                    <?php 
                        Modal::begin([
                            //'header'=>'<h4>Agregar Cliente</h4>',
                            'id'=> 'modal',
                            'size'=>'modal-lg',
                        ]);
                        echo "<div id='modalContent'></div>";

                        Modal::end();
                    ?>     

                </div>
                
            </div>
            
            <!-- Info del Clientes -->
            <div class="row">
                
                <div class="col-md-7">
                    <?=Html::label("DOMICILIO:","cliente_domicilio",["id"=>"cliente_domicilio"])?>
                </div>

                <div class="col-md-4">
                    <?=Html::label("TEL.:","cliente_telefono",["id"=>"cliente_telefono"])?>                
                </div>
                
            </div>

           
            <br>

         
            
            <div class="row">                    
                    
                <!-- Tabla Productos seleccionados -->
                <div class="col-md-12">
                <table class="table table-hover" id="tabla_ventas" border="1">
                    <thead>
                        <tr><th>Cant</th><th>Producto</th><th>Precio Unit.</th><th>Precio Total</th><th></th></tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
                

            </div>
                
                <div class="row">
                    
                    <div class="col-md-10"> 
                        
                        <?= $form->field($model, 'obs')->textArea(['rows' => '2']) ?>   
                        
                        <div class="col-md-2">
                            <!--<?= $form->field($model, 'envio_domicilio')->checkBox(['class'=>'form-control']) ?>-->
                            <?=Html::radio("envio",false,["label"=>"Envio","uncheck"=>true,"value"=>1,'class'=>'form-control'])?>
                        </div>                            

                        <div class="col-md-2">
                            <!--<?= $form->field($model, 'retira')->checkBox(['class'=>'form-control']) ?>-->
                            <?=Html::radio("envio",false,["label"=>"Retira","uncheck"=>true,"value"=>0,'class'=>'form-control'])?>
                        </div>                            

                        <div class="col-md-3">
                            <?= $form->field($model, 'hora_encargue')->textInput() ?> 
                        </div>                         

                        <!--<?=Html::radio("formapago",true,["label"=>"Efectivo","uncheck"=>false,"data-id"=>1])?>
                        <?=Html::radio("formapago",false,["label"=>"Debito","uncheck"=>true,"data-id"=>2])?>
                        <?=Html::radio("formapago",false,["label"=>"Credito","uncheck"=>true,"data-id"=>3])?>
                        <?= $form->field($model, 'forma_pago')->textInput(["type"=>"hidden","value"=>1]) ?>-->                     
                    
                    </div>

                    <div class="col-md-2"> 
                        <?= $form->field($model, 'total')->textInput(['readOnly' =>'readOnly']) ?> 
                        <?= $form->field($model, 'paga')->textInput() ?> 
                        <?= $form->field($model, 'vuelto')->textInput(['readOnly' =>'readOnly']) ?> 
                    </div>   

                </div>   

                 <div class="row">
                    <div class="col-md-10">
                    </div> 
                    <div class="col-md-2">
                        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>                       
                   

                </div>    

            </div><!--fin colmuna derecha -->
              
        </div>

    </div>


<?php $form = ActiveForm::end(); ?>


<script type="text/javascript" src="<?=Yii::$app->request->baseUrl?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=Yii::$app->request->baseUrl?>/js/ventas.js"></script>

