<?php

use yii\db\Migration;

class m260102_120000_fix_voo_trigger extends Migration
{
    public function safeUp()
    {
        $this->execute("DROP TRIGGER IF EXISTS trg_voo_validate");

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
    }

    public function safeDown()
    {
        $this->execute("DROP TRIGGER IF EXISTS trg_voo_validate");
    }
}
