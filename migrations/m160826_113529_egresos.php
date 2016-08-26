<?php

use yii\db\Migration;

class m160826_113529_egresos extends Migration
{
    public function up()
    {
         $this->createTable('egresos', [
            'id' => $this->primaryKey(),
            'fecha' => $this->date()->notNull(),
            'prov_id' => $this->integer(),
            'otro' => $this->string(40),
            'forma_pago' => $this->integer(),
            'obs' => $this->string(120),
            'cantidad' => $this->decimal(15,2),
            'precio' => $this->decimal(15,2)->notNull(),              
            'total' => $this->decimal(15,2)->notNull(),
            'usuario_id' => $this->integer(),
            'turno_id' => $this->integer()->notNull(),
            'prov_id' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('egresos');  
    }

   
}
