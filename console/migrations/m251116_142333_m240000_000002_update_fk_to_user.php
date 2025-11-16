<?php

use yii\db\Migration;

class m251116_142333_m240000_000002_update_fk_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        // 1) ADMINISTRADOR
        // ----------------
        // remover FK antiga para utilizador
        $this->dropForeignKey(
            'fk_admin_utilizador',   // nome da FK antiga
            'administrador'          // tabela onde a FK está definida
        );

        // garantir tipo compatível com user.id
        $this->alterColumn(
            'administrador',
            'id_utilizador',
            $this->integer()->notNull()
        );

        // criar nova FK para user(id)
        $this->addForeignKey(
            'fk_admin_user',         // nome da nova FK
            'administrador',         // tabela filha
            'id_utilizador',         // coluna filha
            'user',                  // tabela pai
            'id',                    // coluna pai
            'CASCADE',               // ON DELETE
            'RESTRICT'               // ON UPDATE
        );



        // 2) FUNCIONARIO
        // --------------
        $this->dropForeignKey(
            'fk_func_utilizador',
            'funcionario'
        );

        $this->alterColumn(
            'funcionario',
            'id_utilizador',
            $this->integer()->notNull()
        );

        $this->addForeignKey(
            'fk_func_user',
            'funcionario',
            'id_utilizador',
            'user',
            'id',
            'CASCADE',
            'RESTRICT'
        );



        // 3) PASSAGEIRO
        // -------------
        $this->dropForeignKey(
            'fk_pass_utilizador',
            'passageiro'
        );

        $this->alterColumn(
            'passageiro',
            'id_utilizador',
            $this->integer()->notNull()
        );

        $this->addForeignKey(
            'fk_pass_user',
            'passageiro',
            'id_utilizador',
            'user',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        echo "This migration 'm251116_142333_m240000_000002_update_fk_to_user' cannot be reverted safely.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251116_142333_m240000_000002_update_fk_to_user cannot be reverted.\n";

        return false;
    }
    */
}
