<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EgresosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Egresos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="egresos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Egresos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute'=>'fecha',
                'value'=> function ($model) {
                    return date("d-m-Y",strtotime($model->fecha));
                }
            ],
            [
                'attribute'=>'prov_id',
                'value'=> 'proveedores.nombre',
            ],
            /*[
                'attribute'=>'prod_id',
                'value'=> 'productos.nombre',
            ],*/            
            'otro',
            //'forma_pago',
            // 'obs',
             'cantidad',
             'precio',
             'total',
            // 'usuario_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
