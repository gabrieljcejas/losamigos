<?php

use yii\db\Migration;

class m160609_004435_clientes extends Migration
{
    public function up()
    {
        $this->createTable('clientes', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(80)->notNull(),
            'domicilio' => $this->string(120)->notNull(),
            'telefono' => $this->string(30),
            'gps' => $this->string(30),
            'obs' => $this->string(120),
            'dni' => $this->integer(),
        ]);
    }

    public function down()
    {        
        $this->dropTable('clientes');        
    }
    
}
