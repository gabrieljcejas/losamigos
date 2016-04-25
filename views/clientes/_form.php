<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-form">

    <?php $form = ActiveForm::begin(); ?>
   

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

<<<<<<< HEAD
    <!--<?= $form->field($model, 'dni')->textInput() ?>-->

    <?= $form->field($model, 'domicilio')->textInput(['maxlength' => true]) ?>
=======
    <?= $form->field($model, 'dni')->textInput() ?>

    <!--<?= $form->field($model, 'domicilio')->textInput(['maxlength' => true]) ?>-->
>>>>>>> origin/master

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'gps')->textInput(['maxlength' => true]) ?>-->

    <!--<?= $form->field($model, 'obs')->textInput() ?>-->



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
