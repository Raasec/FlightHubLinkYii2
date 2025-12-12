<?php

use yii\db\Migration;

class m251210_144200_update_servico_aeroporto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 1. Add new fields
        $this->addColumn('servico_aeroporto', 'image', $this->string(255)->after('horario_funcionamento'));
        $this->addColumn('servico_aeroporto', 'url', $this->string(255)->after('image'));

        // 2. Rename columns Portuguese → English
        $this->renameColumn('servico_aeroporto', 'nome', 'name');
        $this->renameColumn('servico_aeroporto', 'tipo', 'type');
        $this->renameColumn('servico_aeroporto', 'localizacao', 'location');
        $this->renameColumn('servico_aeroporto', 'horario_funcionamento', 'opening_hours');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // revert changes

        // remove added fields
        $this->dropColumn('servico_aeroporto', 'image');
        $this->dropColumn('servico_aeroporto', 'url');

        // rename columns back to Portuguese
        $this->renameColumn('servico_aeroporto', 'name', 'nome');
        $this->renameColumn('servico_aeroporto', 'type', 'tipo');
        $this->renameColumn('servico_aeroporto', 'location', 'localizacao');
        $this->renameColumn('servico_aeroporto', 'opening_hours', 'horario_funcionamento');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251210_144200_update_servico_aeroporto_table cannot be reverted.\n";

        return false;
    }
    */
}
