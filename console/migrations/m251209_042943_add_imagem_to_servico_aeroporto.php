<?php

use yii\db\Migration;

class m251209_042943_add_imagem_to_servico_aeroporto extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('servico_aeroporto', 'imagem', $this->string()->after('horario_funcionamento'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('servico_aeroporto', 'imagem');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251209_042943_add_imagem_to_servico_aeroporto cannot be reverted.\n";

        return false;
    }
    */
}
