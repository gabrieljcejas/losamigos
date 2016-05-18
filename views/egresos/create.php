<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Egresos */

//$this->title = 'Create Egresos';
$this->params['breadcrumbs'][] = ['label' => 'Egresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="egresos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'productos'=>$productos,
        'proveedores'=>$proveedores,
    ]) ?>

</div>
