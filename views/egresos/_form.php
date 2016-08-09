<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2; 
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Egresos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="egresos-form">
    
    <?php $form = ActiveForm::begin(); ?>
     
    <div class="row">
        <div class="col-md-4">
           <label>Fecha</label>
             <div class="input-group">
                <?=
                    DatePicker::widget([
                        'model' => $model,
                        'attribute' => 'fecha',
                        'dateFormat' => 'php:d-m-Y',
                        'options' => [
                            'class' => 'form-control',
                            'readOnly' => 'readOnly',

                        ],
                    ]);
                ?>
                <span class="input-group-addon glyphicon glyphicon-calendar"></span>
            </div>
        </div>
    </div><br>

    <!--<div class="row">        
        <div class="col-md-4">
            <?=$form->field($model, 'prod_id')->widget(Select2::classname(), [
                'data' => $productos,                     
                'options' => ['placeholder' => 'Buscar...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);?>
        </div>
    </div>-->
   
    <div class="row">        
        <div class="col-md-4">
            <?=$form->field($model, 'prov_id')->widget(Select2::classname(), [
                'data' => $proveedores,                     
                'options' => ['placeholder' => 'Buscar...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'otro')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'precio')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'cantidad')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'total')->textInput(['readOnly' => 'readOnly']) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <!--<?= $form->field($model, 'obs')->textArea(['rows' => 2]) ?>-->
        </div>
    </div>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<script type="text/javascript" src="<?=Yii::$app->request->baseUrl?>/js/jquery.min.js"></script>

<script>


 $("#egresos-cantidad").on("keyup", function() {

            var cantidad = parseFloat($("#egresos-cantidad").val());                        
            var total = 0;
            precio = parseFloat($("#egresos-precio").val());
            if (cantidad!=null){                
                total =  cantidad * precio;
            } 
            else{
                alert("entro");
                total =  precio;  
            }
            
            $("#egresos-total").val(total);    
        });


</script>