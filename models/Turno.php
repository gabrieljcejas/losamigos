<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "turno".
 *
 * @property integer $id
 * @property string $fecha
 * @property string $hora_inicio
 * @property string $hora_fin
 * @property string $cant_pollo
 * @property string $sobra_pollo
 */
class Turno extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'turno';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'hora_inicio', 'cant_pollo','caja_inicial'], 'required'],
            [['fecha'], 'safe'],
            [['cant_pollo', 'sobra_pollo','caja_inicial'], 'number'],
            [['hora_inicio', 'hora_fin'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha' => 'Fecha',
            'hora_inicio' => 'Hora Inicio',
            'hora_fin' => 'Hora Fin',
            'cant_pollo' => 'Cantidad de Pollos Incial',
            'sobra_pollo' => 'Stock',
            'caja_inicial' => 'Caja Inicial',
        ];
    }
}
