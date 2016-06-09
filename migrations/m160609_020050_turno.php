<?php

use yii\db\Migration;

class m160609_020050_turno extends Migration
{
    public function up()
    {
        $this->createTable('turno', [
            'id' => $this->primaryKey(),
            'fecha' => $this->date()->notNull(),
            'hora_inicio' => $this->string(10)->notNull(),
            'hora_fin' => $this->string(10),
            'cant_pollo' => $this->decimal(15,2)->notNull(),
            'sobra_pollo' => $this->decimal(15,2),
            'caja_inicial' => $this->decimal(15,2)->notNull(),              
        ]);
    }

    public function down()
    {        
        $this->dropTable('turno');        
    }

}
