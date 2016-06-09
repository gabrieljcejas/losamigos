<?php

use yii\db\Migration;

class m160609_014048_productos extends Migration
{
    public function up()
    {
         $this->createTable('productos', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(60)->notNull(),
            'detalle' => $this->string(120)->notNull(),
            'precio_lista' => $this->decimal(15,2),
            'precio_venta' => $this->decimal(15,2)->notNull(),
            'nombre_foto' => $this->string(30)->notNull(),
            'stock' => $this->integer()->notNull(),
            'stock_minimo' => $this->integer(),
        ]);
    }

    public function down()
    {
       $this->dropTable('productos');        
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
