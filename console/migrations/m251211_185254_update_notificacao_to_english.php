<?php

use yii\db\Migration;

class m251211_185254_update_notificacao_to_english extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('notificacao', 'tipo', 'type');
        $this->renameColumn('notificacao', 'mensagem', 'message');
        $this->renameColumn('notificacao', 'data_envio', 'sent_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('notificacao', 'type', 'tipo');
        $this->renameColumn('notificacao', 'message', 'mensagem');
        $this->renameColumn('notificacao', 'sent_at', 'data_envio');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251211_185254_update_notificacao_to_english cannot be reverted.\n";

        return false;
    }
    */
}
