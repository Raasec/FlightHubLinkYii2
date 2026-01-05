<?php

use yii\db\Migration;

class m260105_173000_update_incidente_trigger extends Migration
{
    public function up()
    {
        $this->execute("DROP TRIGGER IF EXISTS before_insert_incidente");

        $trigger = <<<SQL
CREATE TRIGGER before_insert_incidente BEFORE INSERT ON incidente
FOR EACH ROW
BEGIN
    IF (NEW.id_notificacao IS NOT NULL) THEN
        IF (NOT EXISTS (SELECT 1 FROM notificacao WHERE id_notificacao = NEW.id_notificacao)) THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Notificação inexistente.';
        END IF;
    END IF;
    
    IF (NEW.id_funcionario IS NOT NULL) THEN
        IF (NOT EXISTS (SELECT 1 FROM funcionario WHERE id_funcionario = NEW.id_funcionario)) THEN
             SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Funcionário inexistente.';
        END IF;
    END IF;
END;
SQL;
        $this->execute($trigger);
    }

    public function down()
    {
         $this->execute("DROP TRIGGER IF EXISTS before_insert_incidente");
         $trigger = <<<SQL
CREATE TRIGGER before_insert_incidente BEFORE INSERT ON incidente
FOR EACH ROW
BEGIN
    IF (NOT EXISTS (SELECT 1 FROM notificacao WHERE id_notificacao = NEW.id_notificacao)) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Notificação inexistente.';
    END IF;
END;
SQL;
         $this->execute($trigger);
    }
}
