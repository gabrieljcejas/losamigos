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
<<<<<<< HEAD
                            <!--<?= $form->field($model, 'envio_domicilio')->checkBox(['class'=>'form-control']) ?>-->
                            <?=Html::radio("envio",false,["label"=>"Envio","uncheck"=>true,"value"=>1,'class'=>'form-control'])?>
                        </div>                            

                        <div class="col-md-2">
                            <!--<?= $form->field($model, 'retira')->checkBox(['class'=>'form-control']) ?>-->
                            <?=Html::radio("envio",false,["label"=>"Retira","uncheck"=>true,"value"=>0,'class'=>'form-control'])?>
=======
                            <?= $form->field($model, 'envio_domicilio')->checkBox(['class'=>'form-control']) ?>
                        </div>                            

                        <div class="col-md-2">
                            <?= $form->field($model, 'retira')->checkBox(['class'=>'form-control']) ?>
>>>>>>> origin/master
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

<script>


    function borrarfila(i){    
        $("#del-"+i).remove();
        calculartotal();
    }

    function calculartotal(){
        var suma = 0;            
        $( "input[name='total[]']" ).each(function() {        
            suma = parseFloat($(this).val()) + suma;               
            $( "#ventas-total" ).val(suma);
        });  
    }

<<<<<<< HEAD
  
=======
>>>>>>> origin/master
    // cuando cambia la cantidad cambia el precio total y suma el precio total de la venta
    function myFunction(nrofila){    
       
        var nro_fila =  nrofila;           
        var total=0;
        var cantidad=0;
        var precio_venta=0;
<<<<<<< HEAD
=======


>>>>>>> origin/master
    
        $("input[name='cantidad[]']").each(function(){      

            cantidad = parseFloat($("#cantidad"+nro_fila).val());                          
            precio_venta = parseFloat($("#precio_venta"+nro_fila).val());           
            //alert("cantidad "+ cantidad + " precio_venta "+precio_venta);
            if (cantidad!="" && cantidad>=0){
                $("#total"+nro_fila).val(precio_venta*cantidad);     
            }
            else{            
                $("#total"+nro_fila).val("0.00");   
            }
            return false;            
        }); 
        
        calculartotal();
                
    }

    $(function () {   

        //Modal Button Agregar Cliente
         $("#agregarcliente").on( "click", function() {
           $( "#modal").modal('show').find('#modalContent').load($(this).attr('value'));
            
        }); 
        
        // coloco el valor del radio en el input forma de pago
        $( "input[type=radio]" ).on( "click", function() {
            var valor = $(this).data("id");                       
            $("#ventas-forma_pago").val(valor);
        }); 


        $(".btn_producto").click(function(){                      
          

            var html='';                        
<<<<<<< HEAD
            var nro_fila = $('#tabla_ventas >tbody >tr').length + 1;            
            var boton_prodid = $(this).data("ide");            
            var flag = false;
            var prod_id = 0;
            var precio_venta = 0;
            var cantidad = 0;

            
            $("input[name='producto_id[]']").each( function() {
                
                var fila = $(this).data("fila"); 
                var cantidad = parseFloat($("#cantidad"+fila).val());
                var precioventa = parseFloat($("#precio_venta"+fila).val());
                var suma = 0;
                
                if (boton_prodid == $(this).val()){                    
                    flag = true;
                    suma = cantidad + 1;
                    $("#cantidad"+fila).val(suma);                    
                    $("#total"+fila).val(suma*precioventa);
                }
            });

            if (flag == false){
                html+="<tr id='del-" + nro_fila + "'>";
                    html+="<td><input type='text' id='cantidad"+ nro_fila +"' name='cantidad[]' value='1' class='form-control' style='width: 50px;' onkeyup='myFunction("+nro_fila+")'></td>";                
                    html+="<td><input type='text' readOnly='readOnly' style='width: 200px;' name='producto[]' value='" + $(this).data("nombre") + "' class='form-control'><input type='hidden' name='producto_id[]' value='" + $(this).data("ide") + "' class='form-control' data-fila='"+nro_fila+"'></td>";
                    html+="<td><input type='text' readOnly='readOnly'  id='precio_venta" + nro_fila + "' name='precio_venta[]' value='" + $(this).data("precio_venta") + "' class='form-control'></td>";
                    html+="<td><input type='text'  id='total" + nro_fila + "' name='total[]' value='" + $(this).data("precio_venta") + "' class='form-control'  readOnly='readOnly'></td>";
                    html+="<td><a id='btn_borrar_cuenta' onClick='borrarfila(" + nro_fila + ");' class='btn btn-default glyphicon glyphicon-trash'></a></td>";
                html+="</tr>";

                $("#tabla_ventas").append(html);               
            }

            //agrego la suma de la columna precio total al input total
            calculartotal();
=======
            var nro_fila = $('#tabla_ventas >tbody >tr').length + 1;
            

            html+="<tr id='del-" + nro_fila + "'>";
                html+="<td><input type='text' id='cantidad"+ nro_fila +"' name='cantidad[]' value='1' class='form-control' onkeyup='myFunction("+nro_fila+")' ></td>";                
                html+="<td><input type='text' readOnly='readOnly' name='producto[]' value='" + $(this).data("nombre") + "' class='form-control'><input type='hidden' name='producto_id[]' value='" + $(this).data("ide") + "' class='form-control'></td>";
                html+="<td><input type='text' readOnly='readOnly'  id='precio_venta" + nro_fila + "' name='precio_venta[]' value='" + $(this).data("precio_venta") + "' class='form-control'></td>";
                html+="<td><input type='text'  id='total" + nro_fila + "' name='total[]' value='" + $(this).data("precio_venta") + "' class='form-control'  readOnly='readOnly'></td>";
                html+="<td><a id='btn_borrar_cuenta' onClick='borrarfila(" + nro_fila + ");' class='btn btn-default glyphicon glyphicon-trash'></a></td>";
            html+="</tr>";

            $("#tabla_ventas").append(html);               


            //agrego la suma de la columna precio total al input total
           calculartotal();
>>>>>>> origin/master
                         
        });

        $("#ventas-paga").on("keyup", function() {

            var total = parseFloat($("#ventas-total").val());
            var paga = parseFloat($("#ventas-paga").val());
            var vuelto =  paga - total;
            //alert(vuelto);
            
            $("#ventas-vuelto").val(vuelto);    
        });

         $('#ventas-cliente_id').change(function () {
            
            $.ajax({
                type: "POST",
                url: "../web/index.php?r=ventas/get-info-cliente",
                data: {id: $(this).val()},
                dataType: "json",
                success: function (data) {
                     $.each(data, function(i, clientes) {
                        //alert(clientes.domicilio);
                        $("#cliente_domicilio").text("DOMICILIO: "+clientes.domicilio);
                        $("#cliente_telefono").text("TEL: "+ clientes.telefono);
                    });
               }

            });
        });
        
    });




</script>   
