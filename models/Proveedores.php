<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proveedores".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $domicilio
 * @property string $telefono
 * @property string $cuit
 * @property string $obs
 */
class Proveedores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proveedores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 80],
            [['domicilio', 'obs'], 'string', 'max' => 120],
            [['telefono', 'cuit'], 'string', 'max' => 30],
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
            'cuit' => 'Cuit',
            'obs' => 'Obs',
        ];
    }
}
