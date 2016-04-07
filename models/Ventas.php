<?php

namespace app\models;

use Yii;
use app\models\Egresos;
use app\models\Productos;
/**
 * This is the model class for table "ventas".
 *
 * @property integer $id
 * @property string  $fecha
 * @property integer $cliente_id
 * @property integer $forma_pago
 * @property string  $total
 * @property string  $obs
 * @property integer $usuario_id
 * @property integer $envio_domicilio
 * @property integer $retira
 * @property string  $fecha_encargue
 * @property string  $hora_encargue
 * @property integer $paga
 * @property integer $vuelto
 * @property integer $entregado
 * @property integer $turno_id
 */
class Ventas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ventas';
    }

    /**
     * @Propiedades 
     */    
    public $fecha_desde;
    public $fecha_hasta;

     

    /**
     * @Reglas
     */
    public function rules()
    {
        return [
            [['fecha','total','cliente_id','paga','turno_id'], 'required'],
            [['fecha'], 'safe'],
            [['cliente_id', 'forma_pago', 'usuario_id','envio_domicilio','retira','entregado'], 'integer'],
            [['total','paga','vuelto','turno_id'], 'number'],
            [['obs'], 'string', 'max' => 120],
            [['hora_encargue'], 'string', 'max' => 10],
            [['fecha_encargue'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Nro Venta',
            'fecha' => 'Fecha',
            'cliente_id' => 'CLIENTE',
            'forma_pago' => '',
            'total' => 'Total',
            'obs' => 'Observacion',
            'usuario_id' => 'Usuario ID',
            'envio_domicilio' => 'Envio',
            'fecha_encargue'=>'Fecha',
            'hora_encargue'=>'Hora',
            'retira'=>'Retira',
            'paga'=>'Paga',
            'vuelto'=>'Vuelto',
            'entregado'=>'Entregado',

        ];
    }


    public function getClientes() {
        return $this->hasOne(Clientes::className(), ['id' => 'cliente_id']);
    }
   
    public function getTurno() {
        return $this->hasOne(Turno::className(), ['id' => 'turno_id']);
    }

    public function getVentasDetalle() {
        return $this->hasMany(VentasDetalle::className(), ['venta_id' => 'id']);
    }

    public function getProductosConcatenados($id) {

        $ventadetalle = VentasDetalle::find()->select('prod_id,cant')->where(['venta_id' => $id])->all();
       
        //$concatenar = array();
        foreach ($ventadetalle as $vd) {
            $concatenar = $vd->cant . " " . $vd->productos->nombre . " " .$concatenar;
        }
         //var_dump($concatenar);die;
        return $concatenar;
    }


    /**
    **CALCULO TOTAL VENTAS POR TURNO
    **/
    public function CalcularTotalVentas($turno){
        
        //listo todas las ventas para luego sumarla
        $sumaventas = Ventas::find()->where(['entregado'=>1])->andWhere(['turno_id'=>$turno->id])->orderBy('id DESC')->all();
        
        $totalventas = 0;       
        foreach ($sumaventas as $v) {
            $totalventas = floatval($v->total) + $totalventas;
        }    

       return $totalventas;
    }

    /**
    **CALCULO TOTAL COMPRAS DE LA FECHA POR TURNO    
    **/
    public function CalcularTotalEgresos($turno){

        $egresos = Egresos::find()->where(['turno_id'=>$turno->id])->all();

        $totalegresos = 0;
        
        foreach ($egresos as $e) {
            $totalegresos = floatval($e->total) + $totalegresos;
        }

        return $totalegresos;
    }

    /**
    **CALCULO TOTAL VENTAS POR TURNO, POR CADA PRODUCTO EJ: PROMO, POLLO, PAPA, ENSALADAS, BEBIDAS
    **/
    public function CalcularCantidadProductosVendidos($turno){

        
        $sql = "SELECT p.nombre as 'producto',vd.cant as 'cantidad' FROM `ventas` v
                JOIN ventas_detalle vd ON v.id=vd.venta_id
                JOIN productos p ON p.id=vd.prod_id
                WHERE v.entregado=1 AND v.turno_id=".$turno->id ." ORDER BY  p.nombre,vd.cant";

        $ventas = Ventas::findBySql($sql)->asArray()->all();                  
        $prod_id = 1;
        $sumo = 0;

        foreach ($ventas as $v) {
            
            if ($v['producto'] == $prod_id){
               $sumo = $v['cantidad'] + $sumo;               
               $listado[$v['producto']] = $sumo;
            }else{
                $sumo = 0;
                $sumo = $v['cantidad'] + $sumo;               
                $listado[$v['producto']] = $sumo;
            }

            $prod_id = $v['producto'];
        }

        return  $listado;
   }


}
