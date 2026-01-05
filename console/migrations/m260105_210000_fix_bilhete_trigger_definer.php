<?php

use yii\db\Migration;

/**
 * Class m260105_210000_fix_bilhete_trigger_definer
 */
class m260105_210000_fix_bilhete_trigger_definer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("DROP TRIGGER IF EXISTS trg_bilhete_validate");

        $this->execute("
            CREATE TRIGGER trg_bilhete_validate BEFORE INSERT ON bilhete
            FOR EACH ROW
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM passageiro WHERE id_passageiro = NEW.id_passageiro) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Passageiro inexistente.';
                END IF;

                IF NEW.issue_date > NOW() THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: A data de emissão não pode ser futura.';
                END IF;

                IF NEW.price < 0 THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: O preço do bilhete deve ser positivo.';
                END IF;
            END
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260105_210000_fix_bilhete_trigger_definer cannot be reverted uniquely.\n";
        return true;
    }
}
