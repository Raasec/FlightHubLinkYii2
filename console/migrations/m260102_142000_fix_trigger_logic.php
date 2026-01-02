<?php

use yii\db\Migration;

/**
 * Class m260102_142000_fix_trigger_logic
 */
class m260102_142000_fix_trigger_logic extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 1. Fix trg_checkin_validate to allow NULL id_funcionario
        $this->execute("DROP TRIGGER IF EXISTS trg_checkin_validate");
        $this->execute("
            CREATE TRIGGER trg_checkin_validate BEFORE INSERT ON checkin
            FOR EACH ROW
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM bilhete WHERE id_bilhete = NEW.id_bilhete) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Bilhete inexistente.';
                END IF;

                IF EXISTS (SELECT 1 FROM checkin WHERE id_bilhete = NEW.id_bilhete) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Este bilhete já tem um check-in associado.';
                END IF;

                IF NEW.id_funcionario IS NOT NULL AND NOT EXISTS (SELECT 1 FROM funcionario WHERE id_funcionario = NEW.id_funcionario) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Funcionário inexistente.';
                END IF;
            END
        ");

        // 2. Fix trg_incidente_validate to allow NULL id_funcionario
        $this->execute("DROP TRIGGER IF EXISTS trg_incidente_validate");
        $this->execute("
            CREATE TRIGGER trg_incidente_validate BEFORE INSERT ON incidente
            FOR EACH ROW
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM notificacao WHERE id_notificacao = NEW.id_notificacao) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Notificação inexistente.';
                END IF;

                IF NEW.id_funcionario IS NOT NULL AND NOT EXISTS (SELECT 1 FROM funcionario WHERE id_funcionario = NEW.id_funcionario) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Funcionário inexistente.';
                END IF;

                IF NEW.created_at IS NULL THEN
                    SET NEW.created_at = NOW();
                END IF;
            END
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260102_142000_fix_trigger_logic cannot be reverted without breaking logic again.\n";
        return true;
    }
}
