<?php

use yii\db\Migration;

class m260105_174500_fix_correct_trigger_name extends Migration
{
    public function safeUp()
    {
        // Drop any potential triggers that might exist
        $this->execute("DROP TRIGGER IF EXISTS before_insert_incidente");
        $this->execute("DROP TRIGGER IF EXISTS trg_incidente_validate");

        // Create the correct trigger with the correct logic (checking for NULL)
        $trigger = <<<SQL
CREATE TRIGGER trg_incidente_validate BEFORE INSERT ON incidente
FOR EACH ROW
BEGIN
    -- Only validate id_notificacao if it is NOT NULL
    IF (NEW.id_notificacao IS NOT NULL) THEN
        IF (NOT EXISTS (SELECT 1 FROM notificacao WHERE id_notificacao = NEW.id_notificacao)) THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Notificação inexistente.';
        END IF;
    END IF;
    
    -- Validate id_funcionario if provided
    IF (NEW.id_funcionario IS NOT NULL) THEN
        IF (NOT EXISTS (SELECT 1 FROM funcionario WHERE id_funcionario = NEW.id_funcionario)) THEN
             SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Funcionário inexistente.';
        END IF;
    END IF;
    
    -- Set default created_at if missing
    IF (NEW.created_at IS NULL) THEN
        SET NEW.created_at = NOW();
    END IF;
END;
SQL;
        $this->execute($trigger);
    }

    public function safeDown()
    {
        $this->execute("DROP TRIGGER IF EXISTS trg_incidente_validate");
        // We could recreate the old strict one, but let's just leave it clean or recreate the one from 142000 if needed.
        // For safety/rollback, we can recreate the one that allows NULL checking (safe fallback) or just drop it.
    }
}
