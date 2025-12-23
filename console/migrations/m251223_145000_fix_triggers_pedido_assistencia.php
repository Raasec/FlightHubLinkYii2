<?php

use yii\db\Migration;

class m251223_145000_fix_triggers_pedido_assistencia extends Migration
{
    public function safeUp()
    {
        // Drop the broken trigger
        $this->execute("DROP TRIGGER IF EXISTS trg_pedido_assistencia_validate");

        // Recreate it with correct casing
        $this->execute("
            CREATE TRIGGER trg_pedido_assistencia_validate
            BEFORE INSERT ON pedido_assistencia
            FOR EACH ROW
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM passageiro WHERE id_passageiro = NEW.id_passageiro) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Passageiro inexistente.';
                END IF;

                IF NEW.id_funcionario_resolve IS NOT NULL AND NOT EXISTS (SELECT 1 FROM funcionario WHERE id_funcionario = NEW.id_funcionario_resolve) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Funcionário inexistente.';
                END IF;

                IF NEW.resolution_date IS NOT NULL AND NEW.resolution_date < NEW.request_date THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: A data de resolução não pode ser anterior à data do pedido.';
                END IF;
            END
        ");
    }

    public function safeDown()
    {
        $this->execute("DROP TRIGGER IF EXISTS trg_pedido_assistencia_validate");
        // We do not restore the broken one
    }
}
