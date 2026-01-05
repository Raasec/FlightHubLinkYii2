<?php

use yii\db\Migration;

class m260105_180000_fix_notificacao_trigger extends Migration
{
    public function safeUp()
    {
        $this->execute("DROP TRIGGER IF EXISTS trg_notificacao_auto");

        $trigger = <<<SQL
CREATE TRIGGER trg_notificacao_auto BEFORE INSERT ON notificacao
FOR EACH ROW
BEGIN
    -- Only check for flight existence if id_voo is provided (not global alert)
    IF (NEW.id_voo IS NOT NULL) THEN
        IF (NOT EXISTS (SELECT 1 FROM voo WHERE id_voo = NEW.id_voo)) THEN
             SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Voo inexistente.';
        END IF;
    END IF;

    -- Set default sent_at if missing
    IF (NEW.sent_at IS NULL) THEN
        SET NEW.sent_at = NOW();
    END IF;
END;
SQL;
        $this->execute($trigger);
    }

    public function safeDown()
    {
        // Revert to strict check (this was the state before, but broken for our new feature)
        $this->execute("DROP TRIGGER IF EXISTS trg_notificacao_auto");
         $trigger = <<<SQL
CREATE TRIGGER trg_notificacao_auto BEFORE INSERT ON notificacao
FOR EACH ROW
BEGIN
    IF (NOT EXISTS (SELECT 1 FROM voo WHERE id_voo = NEW.id_voo)) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Voo inexistente.';
    END IF;
    IF (NEW.sent_at IS NULL) THEN
        SET NEW.sent_at = NOW();
    END IF;
END;
SQL;
        $this->execute($trigger);
    }
}
