<?php

use yii\db\Migration;

/**
 * Class m260105_203000_fix_trigger_definers
 */
class m260105_203000_fix_trigger_definers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Drop all potentially problematic triggers
        $this->execute("DROP TRIGGER IF EXISTS trg_checkin_validate");
        $this->execute("DROP TRIGGER IF EXISTS trg_notificacao_auto");
        $this->execute("DROP TRIGGER IF EXISTS trg_check_user_type_admin");
        $this->execute("DROP TRIGGER IF EXISTS trg_check_user_type_funcionario");
        $this->execute("DROP TRIGGER IF EXISTS trg_check_user_type_passageiro");
        $this->execute("DROP TRIGGER IF EXISTS trg_incidente_validate");
        $this->execute("DROP TRIGGER IF EXISTS trg_voo_validate");
        $this->execute("DROP TRIGGER IF EXISTS trg_servico_validate");

        // Recreate them (this will set DEFINER to current user)

        // 1. trg_checkin_validate
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

        // 5. trg_check_user_type_passageiro
        $this->execute("
            CREATE TRIGGER trg_check_user_type_passageiro BEFORE INSERT ON passageiro
            FOR EACH ROW
            BEGIN
                IF EXISTS (SELECT 1 FROM administrador WHERE id_utilizador = NEW.id_utilizador)
                   OR EXISTS (SELECT 1 FROM funcionario WHERE id_utilizador = NEW.id_utilizador) THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Erro: Este utilizador já está registado como Administrador ou Funcionário.';
                END IF;
            END
        ");

        // 6. trg_incidente_validate (using updated logic allowing NULL checks which is safer/better)
        $this->execute("
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
            END
        ");

        // 7. trg_voo_validate
        $this->execute("
            CREATE TRIGGER trg_voo_validate
            BEFORE INSERT ON voo
            FOR EACH ROW
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM companhia_aerea WHERE id_companhia = NEW.id_companhia) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Companhia aérea inexistente.';
                END IF;

                IF NEW.arrival_date IS NOT NULL AND NEW.departure_date IS NOT NULL AND NEW.arrival_date < NEW.departure_date THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: A data de chegada não pode ser anterior à data de partida.';
                END IF;

                IF NEW.departure_date IS NULL THEN
                    SET NEW.departure_date = CURDATE();
                END IF;
            END
        ");

        // 8. trg_servico_validate
        $this->execute("
            CREATE TRIGGER trg_servico_validate
            BEFORE INSERT ON servico_aeroporto
            FOR EACH ROW
            BEGIN
                IF NEW.name IS NULL OR TRIM(NEW.name) = '' THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: O nome do serviço é obrigatório.';
                END IF;
                IF NEW.location IS NULL OR TRIM(NEW.location) = '' THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: A localização do serviço é obrigatória.';
                END IF;
            END
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260105_203000_fix_trigger_definers cannot be reverted uniquely as it overwrites existing triggers.\n";
        return true;
    }
}
