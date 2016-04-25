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
        <?= Html::a('Create Turno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
<<<<<<< HEAD
            'id',
            [
                'attribute'=>'fecha',
                'value'=> function ($model) {
                    return date("d-m-Y",strtotime($model->fecha));
                }
            ],
=======

            'id',
            'fecha',
>>>>>>> origin/master
            'hora_inicio',
            'hora_fin',
            'cant_pollo',
            // 'sobra_pollo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
