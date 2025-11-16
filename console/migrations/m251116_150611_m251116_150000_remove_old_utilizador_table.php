<?php

use yii\db\Migration;

class m251116_150611_m251116_150000_remove_old_utilizador_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Só apaga se existir
        if ($this->db->schema->getTableSchema('utilizador', true) !== null) {
            $this->dropTable('utilizador');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "Cannot restore old utilizador table.\n";
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251116_150611_m251116_150000_remove_old_utilizador_table cannot be reverted.\n";

        return false;
    }
    */
}
