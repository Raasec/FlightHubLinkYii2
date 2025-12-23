<?php

use yii\db\Migration;

class m251223_144500_fix_triggers_case_sensitivity extends Migration
{
    public function safeUp()
    {
        // Drop the broken trigger
        $this->execute("DROP TRIGGER IF EXISTS trg_check_user_type_passageiro");

        // Recreate it with correct casing
        $this->execute("
            CREATE TRIGGER trg_check_user_type_passageiro
            BEFORE INSERT ON passageiro
            FOR EACH ROW
            BEGIN
                IF EXISTS (SELECT 1 FROM administrador WHERE id_utilizador = NEW.id_utilizador)
                   OR EXISTS (SELECT 1 FROM funcionario WHERE id_utilizador = NEW.id_utilizador) THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Erro: Este utilizador já está registado como Administrador ou Funcionário.';
                END IF;
            END
        ");
    }

    public function safeDown()
    {
        $this->execute("DROP TRIGGER IF EXISTS trg_check_user_type_passageiro");
        // We do not restore the broken one
    }
}
