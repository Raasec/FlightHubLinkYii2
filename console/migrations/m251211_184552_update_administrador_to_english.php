<?php

use yii\db\Migration;

class m251211_184552_update_administrador_to_english extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // nivel_acesso -> access_level
        $this->renameColumn('administrador', 'nivel_acesso', 'access_level');

        // responsavel_area -> area_responsible
        $this->renameColumn('administrador', 'responsavel_area', 'area_responsible');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Revert names
        $this->renameColumn('administrador', 'access_level', 'nivel_acesso');
        $this->renameColumn('administrador', 'area_responsible', 'responsavel_area');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251211_184552_update_administrador_to_english cannot be reverted.\n";

        return false;
    }
    */
}
