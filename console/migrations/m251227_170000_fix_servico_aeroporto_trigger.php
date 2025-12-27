<?php

use yii\db\Migration;

class m251227_170000_fix_servico_aeroporto_trigger extends Migration
{
    public function safeUp()
    {
        $this->execute("DROP TRIGGER IF EXISTS trg_servico_validate");

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

    public function safeDown()
    {
        $this->execute("DROP TRIGGER IF EXISTS trg_servico_validate");

        $this->execute("
            CREATE TRIGGER trg_servico_validate
            BEFORE INSERT ON servico_aeroporto
            FOR EACH ROW
            BEGIN
                IF NEW.nome IS NULL OR TRIM(NEW.nome) = '' THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: O nome do serviço é obrigatório.';
                END IF;
                IF NEW.localizacao IS NULL OR TRIM(NEW.localizacao) = '' THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: A localização do serviço é obrigatória.';
                END IF;
            END
        ");
    }
}
