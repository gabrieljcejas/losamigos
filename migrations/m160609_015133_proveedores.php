<?php

use yii\db\Migration;

class m160609_015133_proveedores extends Migration
{
    public function up()
    {
       $this->createTable('proveedores', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(80)->notNull(),
            'domicilio' => $this->string(120),
            'telefono' => $this->string(30),
            'cuit' => $this->string(30),
            'obs' => $this->string(120),                        
        ]);
    }

    public function down()
    {        
        $this->dropTable('proveedores');        
    }

    
}
