<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $domicilio
 * @property string $telefono
 * @property string $gps
 * @property string $obs
 * @property integer $dni
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'domicilio'], 'required'],
            [['dni'], 'integer'],
            [['nombre'], 'string', 'max' => 80],
            [['domicilio'], 'string', 'max' => 120],
            [['telefono'], 'string', 'max' => 30],
            [['gps'], 'string', 'max' => 60],
            [['obs'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'domicilio' => 'Domicilio',
            'telefono' => 'Telefono',
            'gps' => 'Gps',
            'obs' => 'Obs',
            'dni' => 'Dni',
        ];
    }
}
