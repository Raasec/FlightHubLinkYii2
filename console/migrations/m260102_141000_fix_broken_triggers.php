<?php

use yii\db\Migration;

/**
 * Class m260102_141000_fix_broken_triggers
 */
class m260102_141000_fix_broken_triggers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 1. trg_checkin_validate
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

                IF NOT EXISTS (SELECT 1 FROM funcionario WHERE id_funcionario = NEW.id_funcionario) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Funcionário inexistente.';
                END IF;
            END
        ");

        // 2. trg_notificacao_auto
        $this->execute("DROP TRIGGER IF EXISTS trg_notificacao_auto");
        $this->execute("
            CREATE TRIGGER trg_notificacao_auto BEFORE INSERT ON notificacao
            FOR EACH ROW
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM voo WHERE id_voo = NEW.id_voo) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Voo inexistente.';
                END IF;

                IF NEW.message IS NULL OR TRIM(NEW.message) = '' THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: A mensagem da notificação não pode ser vazia.';
                END IF;

                IF NEW.sent_at IS NULL THEN
                    SET NEW.sent_at = NOW();
                END IF;
            END
        ");

        // 3. trg_check_user_type_admin
        $this->execute("DROP TRIGGER IF EXISTS trg_check_user_type_admin");
        $this->execute("
            CREATE TRIGGER trg_check_user_type_admin BEFORE INSERT ON administrador
            FOR EACH ROW
            BEGIN
                IF EXISTS (SELECT 1 FROM funcionario WHERE id_utilizador = NEW.id_utilizador)
                   OR EXISTS (SELECT 1 FROM passageiro WHERE id_utilizador = NEW.id_utilizador) THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Erro: Este utilizador já está registado como Funcionário ou Passageiro.';
                END IF;
            END
        ");

        // 4. trg_check_user_type_funcionario
        $this->execute("DROP TRIGGER IF EXISTS trg_check_user_type_funcionario");
        $this->execute("
            CREATE TRIGGER trg_check_user_type_funcionario BEFORE INSERT ON funcionario
            FOR EACH ROW
            BEGIN
                IF EXISTS (SELECT 1 FROM administrador WHERE id_utilizador = NEW.id_utilizador)
                   OR EXISTS (SELECT 1 FROM passageiro WHERE id_utilizador = NEW.id_utilizador) THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Erro: Este utilizador já está registado como Administrador ou Passageiro.';
                END IF;
            END
        ");

        // 5. trg_incidente_validate
        $this->execute("DROP TRIGGER IF EXISTS trg_incidente_validate");
        $this->execute("
            CREATE TRIGGER trg_incidente_validate BEFORE INSERT ON incidente
            FOR EACH ROW
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM notificacao WHERE id_notificacao = NEW.id_notificacao) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Notificação inexistente.';
                END IF;

                IF NOT EXISTS (SELECT 1 FROM funcionario WHERE id_funcionario = NEW.id_funcionario) THEN
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
        echo "m260102_141000_fix_broken_triggers cannot be reverted without restoring original broken triggers.\n";
        return true;
    }
}
