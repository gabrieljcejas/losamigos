<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;


$this->title = $accion;
$this->params['breadcrumbs'][] = 'Reportes / ' . $this->title;
?>


<h1><?=Html::encode($this->title)?></h1><br>

<?php $form = ActiveForm::begin();?>

<div class="row">

	<div class="col-md-3">
     <label>Fecha Desde</label>
     <div class="input-group">
      	<?=
			DatePicker::widget([
				'name' => 'fecha_desde',
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

	<div class="col-md-3">
     <label>Fecha Hasta</label>
     <div class="input-group">
      	<?=
			DatePicker::widget([
				'name' => 'fecha_hasta',
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

<div><?=Html::submitButton('Buscar', ['class' => 'btn btn-success'])?></div>


<?php $form = ActiveForm::end();?>