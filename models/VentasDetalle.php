<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ventas_detalle".
 *
 * @property integer $id
 * @property integer $venta_id
 * @property integer $prod_id
 * @property integer $cant
 * @property string $precio
 */
class VentasDetalle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ventas_detalle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['venta_id', 'prod_id', 'cant', 'precio'], 'required'],
            [['venta_id', 'prod_id', 'cant'], 'integer'],
            [['precio'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'venta_id' => 'Venta ID',
            'prod_id' => 'Prod ID',
            'cant' => 'Cant',
            'precio' => 'Precio',
        ];
    }

    public function getVentas() {
        return $this->hasOne(Ventas::className(), ['id' => 'venta_id']);
    }
    
    public function getProductos() {
        return $this->hasOne(Productos::className(), ['id' => 'prod_id']);
    }
    
}
