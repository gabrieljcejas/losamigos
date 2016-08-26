<?php

use yii\db\Migration;

class m160826_123909_ventas extends Migration
{
    public function up()
    {
        $this->createTable('clientes', [
            'id' => $this->primaryKey(),
            'fecha' => $this->date()->notNull(),
            'cliente_id' => $this->integer()->notNull(),
            'forma_pago' => $this->integer()->notNull(),            
            'obs' => $this->string(120),
            'envio_domicilio' => $this->integer(),
            'retira' => $this->integer(),
            'fecha_encargue' => $this->date(),
            'hora_encargue' => $this->string(10),
            'total' => $this->decimal(15,2)->notNull(),
            'paga' => $this->decimal(15,2),
            'vuelto' => $this->decimal(15,2),
            'entregado' => $this->integer(),
            'usuario_id' => $this->integer(),
            'turno_id' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('ventas');
    }

}
