<?php

use yii\db\Migration;

class m251209_043602_link_tables_to_user_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /** -------------------------------------------------------------
         * 1. Add new FK column user_profile_id to each role table
         * -------------------------------------------------------------- */

        // funcionario
        $this->addColumn('funcionario', 'user_profile_id', $this->integer()->null());
        // passageiro
        $this->addColumn('passageiro', 'user_profile_id', $this->integer()->null());
        // administrador
        $this->addColumn('administrador', 'user_profile_id', $this->integer()->null());

        /** -------------------------------------------------------------
         * 2. Populate new user_profile_id by JOIN with user_profile
         * -------------------------------------------------------------- */

        // funcionario
        $this->execute("
            UPDATE funcionario f
            JOIN user_profile up ON up.user_id = f.id_utilizador
            SET f.user_profile_id = up.id
        ");

        // passageiro
        $this->execute("
            UPDATE passageiro p
            JOIN user_profile up ON up.user_id = p.id_utilizador
            SET p.user_profile_id = up.id
        ");

        // administrador
        $this->execute("
            UPDATE administrador a
            JOIN user_profile up ON up.user_id = a.id_utilizador
            SET a.user_profile_id = up.id
        ");

        /** -------------------------------------------------------------
         * 3. Add foreign keys linking to user_profile
         * -------------------------------------------------------------- */

        $this->addForeignKey(
            'fk_funcionario_user_profile',
            'funcionario',
            'user_profile_id',
            'user_profile',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_passageiro_user_profile',
            'passageiro',
            'user_profile_id',
            'user_profile',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_administrador_user_profile',
            'administrador',
            'user_profile_id',
            'user_profile',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop new FKs
        $this->dropForeignKey('fk_funcionario_user_profile', 'funcionario');
        $this->dropForeignKey('fk_passageiro_user_profile', 'passageiro');
        $this->dropForeignKey('fk_administrador_user_profile', 'administrador');

        // Remove columns
        $this->dropColumn('funcionario', 'user_profile_id');
        $this->dropColumn('passageiro', 'user_profile_id');
        $this->dropColumn('administrador', 'user_profile_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251209_043602_link_tables_to_user_profile cannot be reverted.\n";

        return false;
    }
    */
}
