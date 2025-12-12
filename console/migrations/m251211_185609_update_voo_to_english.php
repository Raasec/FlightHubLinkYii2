<?php

use yii\db\Migration;

class m251211_185609_update_voo_to_english extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Column names
        $this->renameColumn('voo', 'origem', 'origin');
        $this->renameColumn('voo', 'destino', 'destination');
        $this->renameColumn('voo', 'data_partida', 'departure_date');
        $this->renameColumn('voo', 'porta_embarque', 'gate');
        $this->renameColumn('voo', 'data_chegada', 'arrival_date');
        $this->renameColumn('voo', 'estado', 'status');

        // ENUM tipo_voo: 'partida','chegada' -> 'departure','arrival'

        // 1) Expand enum to include both PT + EN
        $this->execute("
            ALTER TABLE voo
            MODIFY tipo_voo ENUM('partida','chegada','departure','arrival') NULL;
        ");

        // 2) Update existing data
        $this->execute("UPDATE voo SET tipo_voo = 'departure' WHERE tipo_voo = 'partida';");
        $this->execute("UPDATE voo SET tipo_voo = 'arrival'   WHERE tipo_voo = 'chegada';");

        // 3) Restrict enum to EN only
        $this->execute("
            ALTER TABLE voo
            MODIFY tipo_voo ENUM('departure','arrival') NULL;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // 1) Expand enum to support both EN + PT
        $this->execute("
            ALTER TABLE voo
            MODIFY tipo_voo ENUM('partida','chegada','departure','arrival') NULL;
        ");

        // 2) Revert data to Portuguese
        $this->execute("UPDATE voo SET tipo_voo = 'partida' WHERE tipo_voo = 'departure';");
        $this->execute("UPDATE voo SET tipo_voo = 'chegada' WHERE tipo_voo = 'arrival';");

        // 3) Restrict enum back to PT only
        $this->execute("
            ALTER TABLE voo
            MODIFY tipo_voo ENUM('partida','chegada') NULL;
        ");

        // Restore column names
        $this->renameColumn('voo', 'origin', 'origem');
        $this->renameColumn('voo', 'destination', 'destino');
        $this->renameColumn('voo', 'departure_date', 'data_partida');
        $this->renameColumn('voo', 'gate', 'porta_embarque');
        $this->renameColumn('voo', 'arrival_date', 'data_chegada');
        $this->renameColumn('voo', 'status', 'estado');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251211_185609_update_voo_to_english cannot be reverted.\n";

        return false;
    }
    */
}
