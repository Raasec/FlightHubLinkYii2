<?php

use yii\db\Migration;

class m251209_042138_update_voo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        // Add tipo_voo ENUM
        $this->addColumn('voo', 'tipo_voo', "ENUM('partida','chegada') AFTER destino");

        // Rename data_registo → data_partida
        $this->renameColumn('voo', 'data_registo', 'data_partida');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('voo', 'data_partida', 'data_registo');
        $this->dropColumn('voo', 'tipo_voo');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251209_042138_update_voo_table cannot be reverted.\n";

        return false;
    }
    */
}
