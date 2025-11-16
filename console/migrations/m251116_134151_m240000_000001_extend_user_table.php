<?php

use yii\db\Migration;

class m251116_134151_m240000_000001_extend_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        // nome do utilizador (equivalente a utilizador.nome)
        $this->addColumn('{{%user}}', 'nome', $this->string(100)->after('username'));

        // tipo de utilizador (passageiro, funcionario, administrador, etc.)
        $this->addColumn('{{%user}}', 'tipo_utilizador', $this->string(50)->after('email'));

        // data de registo (do DER)
        $this->addColumn('{{%user}}', 'data_registo', $this->date()->after('created_at'));

    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'data_registo');
        $this->dropColumn('{{%user}}', 'tipo_utilizador');
        $this->dropColumn('{{%user}}', 'nome');

        echo "m251116_134151_m240000_000001_extend_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251116_134151_m240000_000001_extend_user_table cannot be reverted.\n";

        return false;
    }
    */
}
