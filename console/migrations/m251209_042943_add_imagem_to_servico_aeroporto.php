<?php

use yii\db\Migration;

class m251209_042943_add_imagem_to_servico_aeroporto extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m251209_042943_add_imagem_to_servico_aeroporto cannot be reverted.\n";

        return false;
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
