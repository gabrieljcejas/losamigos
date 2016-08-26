<?php

use yii\db\Migration;

class m160826_124956_ventas_detalle extends Migration
{
    public function up()
    {
        $this->createTable('clientes', [
            'id' => $this->primaryKey()->notNull(),            
            'venta_id' => $this->integer()->notNull(), 
            'prod_id' => $this->integer()->notNull(),                         
            'cant' => $this->integer()->notNull(), 
            'precio' => $this->decimal(15,2)->notNull(), 
        ]);
    }

    public function down()
    {
        $this->dropTable('ventas_detalle');
    }

   
}
