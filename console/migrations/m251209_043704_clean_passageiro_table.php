<?php

use yii\db\Migration;

class m251209_043704_clean_passageiro_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('passageiro', 'nif');
        $this->dropColumn('passageiro', 'telefone');
        $this->dropColumn('passageiro', 'nacionalidade');
        $this->dropColumn('passageiro', 'data_nascimento');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('passageiro', 'nif', $this->string(15));
        $this->addColumn('passageiro', 'telefone', $this->string(20));
        $this->addColumn('passageiro', 'nacionalidade', $this->string(50));
        $this->addColumn('passageiro', 'data_nascimento', $this->date());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251209_043704_clean_passageiro_table cannot be reverted.\n";

        return false;
    }
    */
}
