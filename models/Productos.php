<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $detalle
 * @property string $precio_lista
 * @property string $precio_venta
 * @property string $nombre_foto
 * @property string $stock
 * @property string $stock_minimo
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'precio_lista', 'precio_venta', 'nombre_foto'], 'required'],
            [['precio_lista', 'precio_venta','stock', 'stock_minimo'], 'number'],
            [['nombre'], 'string', 'max' => 60],
            [['detalle'], 'string', 'max' => 120],
            [['nombre_foto'], 'string', 'max' => 30],
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
            'detalle' => 'Detalle',
            'precio_lista' => 'Precio Lista',
            'precio_venta' => 'Precio Venta',
            'nombre_foto' => 'Nombre Foto',
            'stock' => 'Stock',
            'stock_minimo' => 'Stock Minimo',
        ];
    }

    public function getProductos() {
        return $this->hasMany(Productos::className(), ['prod_id' => 'id']);
    }
}
