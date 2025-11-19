<?php

use yii\db\Migration;

/**
 * Class m250000_000100_cleanup_user_table
 *
 * Limpa a tabela `user` removendo colunas extra:
 *  - nome
 *  - tipo_utilizador
 *  - data_registo
 *
 * E permite reverter (safeDown) recriando-as.
 */
class m251118_170836_m250000_000100_cleanup_user_table extends Migration
{
    public function safeUp()
    {
        // Atenção: se alguma destas colunas já não existir, esta linha dá erro.
        // Garante primeiro no phpMyAdmin que elas existem.

        // Remover coluna `nome`
        if ($this->db->schema->getTableSchema('{{%user}}')->getColumn('nome') !== null) {
            $this->dropColumn('{{%user}}', 'nome');
        }

        // Remover coluna `tipo_utilizador`
        if ($this->db->schema->getTableSchema('{{%user}}')->getColumn('tipo_utilizador') !== null) {
            $this->dropColumn('{{%user}}', 'tipo_utilizador');
        }

        // Remover coluna `data_registo`
        if ($this->db->schema->getTableSchema('{{%user}}')->getColumn('data_registo') !== null) {
            $this->dropColumn('{{%user}}', 'data_registo');
        }
    }

    public function safeDown()
    {
        // Recria as colunas como estavam "logicamente"
        // (caso precises de reverter a migration)

        $schema = $this->db->schema->getTableSchema('{{%user}}');

        if ($schema->getColumn('nome') === null) {
            $this->addColumn('{{%user}}', 'nome', $this->string(100)->null()->after('username'));
        }

        if ($schema->getColumn('tipo_utilizador') === null) {
            $this->addColumn('{{%user}}', 'tipo_utilizador', $this->string(50)->null()->after('email'));
        }

        if ($schema->getColumn('data_registo') === null) {
            $this->addColumn('{{%user}}', 'data_registo', $this->date()->null()->after('created_at'));
        }
    }
}
