<?php

use yii\db\Migration;

/**
 * Class m250000_000110_fix_user_relations
 *
 * Garante que as tabelas passageiro, funcionario e administrador
 * têm foreign keys corretas para user(id).
 */
class m251119_000712_m250000_000110_fix_user_relations extends Migration
{
    public function safeUp()
    {
        $schema = $this->db->schema;

        // PASSAGEIRO
        if ($schema->getTableSchema('{{%passageiro}}') !== null) {

            // Opcional: se souberes o nome de uma FK antiga, podes fazer drop aqui antes de criar nova
            // $this->dropForeignKey('fk_passageiro_utilizador', '{{%passageiro}}');

            // Criar FK se ainda não existir
            $this->addForeignKey(
                'fk_passageiro_user',
                '{{%passageiro}}',
                'id_utilizador',
                '{{%user}}',
                'id',
                'CASCADE',
                'CASCADE'
            );
        }

        // FUNCIONARIO
        if ($schema->getTableSchema('{{%funcionario}}') !== null) {
            $this->addForeignKey(
                'fk_funcionario_user',
                '{{%funcionario}}',
                'id_utilizador',
                '{{%user}}',
                'id',
                'CASCADE',
                'CASCADE'
            );
        }

        // ADMINISTRADOR
        if ($schema->getTableSchema('{{%administrador}}') !== null) {
            $this->addForeignKey(
                'fk_administrador_user',
                '{{%administrador}}',
                'id_utilizador',
                '{{%user}}',
                'id',
                'CASCADE',
                'CASCADE'
            );
        }
    }

    public function safeDown()
    {
        $schema = $this->db->schema;

        if ($schema->getTableSchema('{{%passageiro}}') !== null) {
            $this->dropForeignKey('fk_passageiro_user', '{{%passageiro}}');
        }

        if ($schema->getTableSchema('{{%funcionario}}') !== null) {
            $this->dropForeignKey('fk_funcionario_user', '{{%funcionario}}');
        }

        if ($schema->getTableSchema('{{%administrador}}') !== null) {
            $this->dropForeignKey('fk_administrador_user', '{{%administrador}}');
        }
    }
}
