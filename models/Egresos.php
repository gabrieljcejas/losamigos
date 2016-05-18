<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "egresos".
 *
 * @property integer $id
 * @property string $fecha
 * @property integer $prod_id
 * @property string $otro
 * @property integer $forma_pago
 * @property string $obs
 * @property integer $cantidad
 * @property integer $precio
 * @property string $total
 * @property integer $usuario_id
 * @property integer $turno_id
 * @property integer $prov_id
 */
class Egresos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'egresos';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'precio', 'total','cantidad','prov_id'], 'required'],
            [['fecha'], 'safe'],
            [['prod_id','forma_pago','usuario_id','turno_id','prov_id'], 'integer'],
            [['total', 'cantidad', 'precio'], 'number'],
            [['obs'], 'string', 'max' => 120],
            [['otro'], 'string', 'max' => 40],
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
            'prod_id' => 'Producto',
            'otro' => 'Detalle',
            'forma_pago' => 'Forma Pago',
            'obs' => 'Obs',
            'cantidad' => 'Cantidad',
            'precio' => 'Precio',
            'total' => 'Total',
            'usuario_id' => 'Usuario ID',
            'turno_id' => 'Turno',
            'prov_id' => 'Proveedor',   
        ];
    }


    public function getProductos() {
        return $this->hasOne(Productos::className(), ['id' => 'prod_id']);
    }

    public function getProveedores() {
        return $this->hasOne(Proveedores::className(), ['id' => 'prov_id']);
    }
}
