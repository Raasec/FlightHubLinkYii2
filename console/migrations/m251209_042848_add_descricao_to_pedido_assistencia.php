<?php

use yii\db\Migration;

class m251209_042848_add_descricao_to_pedido_assistencia extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pedido_assistencia', 'descricao', $this->text()->after('estado'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('pedido_assistencia', 'descricao');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251209_042848_add_descricao_to_pedido_assistencia cannot be reverted.\n";

        return false;
    }
    */
}
