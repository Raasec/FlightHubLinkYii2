<?php

use yii\db\Migration;

class m251211_185434_update_pedido_assistencia_to_english extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('pedido_assistencia', 'tipo', 'type');
        $this->renameColumn('pedido_assistencia', 'data_pedido', 'request_date');
        $this->renameColumn('pedido_assistencia', 'data_resolucao', 'resolution_date');
        $this->renameColumn('pedido_assistencia', 'estado', 'status');
        $this->renameColumn('pedido_assistencia', 'descricao', 'description');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('pedido_assistencia', 'type', 'tipo');
        $this->renameColumn('pedido_assistencia', 'request_date', 'data_pedido');
        $this->renameColumn('pedido_assistencia', 'resolution_date', 'data_resolucao');
        $this->renameColumn('pedido_assistencia', 'status', 'estado');
        $this->renameColumn('pedido_assistencia', 'description', 'descricao');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251211_185434_update_pedido_assistencia_to_english cannot be reverted.\n";

        return false;
    }
    */
}
