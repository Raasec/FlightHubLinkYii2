<?php

use yii\db\Migration;

/**
 * Class m260102_130000_fix_bilhete_trigger
 */
class m260102_130000_fix_bilhete_trigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // damos drop a este trigger que esta a causar problemas
        $this->execute("DROP TRIGGER IF EXISTS trg_bilhete_validate");

        // Passageiro -> passageiro
        // data_emissao -> issue_date
        // preco -> price
        $trigger = <<<SQL
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
END;
SQL;

        $this->execute($trigger);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("DROP TRIGGER IF EXISTS trg_bilhete_validate");
        // We don't restore the broken trigger
    }
}
