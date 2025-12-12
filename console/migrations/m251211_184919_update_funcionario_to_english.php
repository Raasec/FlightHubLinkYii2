<?php

use yii\db\Migration;

class m251211_184919_update_funcionario_to_english extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Column names
        $this->renameColumn('funcionario', 'departamento', 'department');
        $this->renameColumn('funcionario', 'cargo', 'job_position');
        $this->renameColumn('funcionario', 'data_contratacao', 'hire_date');

        // 1) Expand ENUM to support both PT + EN values
        $this->execute("
            ALTER TABLE funcionario
            MODIFY turno ENUM('dia','tarde','noite','day','afternoon','night') NULL;
        ");

        // 2) Convert existing values
        $this->execute("UPDATE funcionario SET turno = 'day'       WHERE turno = 'dia';");
        $this->execute("UPDATE funcionario SET turno = 'afternoon' WHERE turno = 'tarde';");
        $this->execute("UPDATE funcionario SET turno = 'night'     WHERE turno = 'noite';");

        // 3) Restrict ENUM to English-only values
        $this->execute("
            ALTER TABLE funcionario
            MODIFY turno ENUM('day','afternoon','night') NULL;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // 1) Expand ENUM to support both EN + PT values
        $this->execute("
            ALTER TABLE funcionario
            MODIFY turno ENUM('dia','tarde','noite','day','afternoon','night') NULL;
        ");

        // 2) Convert values back to Portuguese
        $this->execute("UPDATE funcionario SET turno = 'dia'    WHERE turno = 'day';");
        $this->execute("UPDATE funcionario SET turno = 'tarde'  WHERE turno = 'afternoon';");
        $this->execute("UPDATE funcionario SET turno = 'noite'  WHERE turno = 'night';");

        // 3) Restrict ENUM back to PT-only values
        $this->execute("
            ALTER TABLE funcionario
            MODIFY turno ENUM('dia','tarde','noite') NULL;
        ");

        // Column names back to PT
        $this->renameColumn('funcionario', 'department', 'departamento');
        $this->renameColumn('funcionario', 'job_position', 'cargo');
        $this->renameColumn('funcionario', 'hire_date', 'data_contratacao');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251211_184919_update_funcionario_to_english cannot be reverted.\n";

        return false;
    }
    */
}
