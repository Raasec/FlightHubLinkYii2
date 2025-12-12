<?php

use yii\db\Migration;

class m251211_185342_update_passageiro_to_english extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('passageiro', 'preferencias', 'preferences');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('passageiro', 'preferences', 'preferencias');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251211_185342_update_passageiro_to_english cannot be reverted.\n";

        return false;
    }
    */
}
