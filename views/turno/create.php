<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Turno */

$this->title = 'Cargar Turno';
$this->params['breadcrumbs'][] = ['label' => 'Turnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="turno-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
