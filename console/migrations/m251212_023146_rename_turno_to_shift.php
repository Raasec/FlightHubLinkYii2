<?php

use yii\db\Migration;

class m251212_023146_rename_turno_to_shift extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('funcionario', 'turno', 'shift');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('funcionario', 'shift', 'turno');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251212_023146_rename_turno_to_shift cannot be reverted.\n";

        return false;
    }
    */
}
