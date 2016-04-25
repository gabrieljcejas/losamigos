<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
<<<<<<< HEAD
use yii\jui\DatePicker;
=======
>>>>>>> origin/master

/* @var $this yii\web\View */
/* @var $model app\models\Turno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="turno-form">

    <?php $form = ActiveForm::begin(); ?>

<<<<<<< HEAD
    <label>Fecha</label>
     <div class="input-group">
        <?=
            DatePicker::widget([
                'model' => $model,
                'attribute' => 'fecha',
                'dateFormat' => 'php:d-m-Y',
                'options' => [
                    'class' => 'form-control',
                ],
            ]);
        ?>
        <span class="input-group-addon glyphicon glyphicon-calendar"></span>
    </div><br>
=======
    <?= $form->field($model, 'fecha')->textInput() ?>
>>>>>>> origin/master

    <?= $form->field($model, 'hora_inicio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hora_fin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cant_pollo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sobra_pollo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'caja_inicial')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
