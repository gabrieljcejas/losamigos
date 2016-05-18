<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TurnoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Turnos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="turno-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Turno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute'=>'fecha',
                'value'=> function ($model) {
                    return date("d-m-Y",strtotime($model->fecha));
                }
            ],
            'cant_pollo',
            'caja_inicial',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
