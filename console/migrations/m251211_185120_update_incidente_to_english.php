<?php

use yii\db\Migration;

class m251211_185120_update_incidente_to_english extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('incidente', 'tipo', 'type');
        $this->renameColumn('incidente', 'descricao', 'description');
        $this->renameColumn('incidente', 'data_registo', 'created_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('incidente', 'type', 'tipo');
        $this->renameColumn('incidente', 'description', 'descricao');
        $this->renameColumn('incidente', 'created_at', 'data_registo');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251211_185120_update_incidente_to_english cannot be reverted.\n";

        return false;
    }
    */
}
