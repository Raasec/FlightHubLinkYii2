<?php

use yii\db\Migration;

class m251210_144634_update_companhia_aerea_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 1. Add image field
        $this->addColumn('companhia_aerea', 'image', $this->string(255)->after('pais_origem'));

        // 2. Rename columns
        $this->renameColumn('companhia_aerea', 'nome', 'name');
        $this->renameColumn('companhia_aerea', 'codigo_iata', 'iata_code');
        $this->renameColumn('companhia_aerea', 'pais_origem', 'country_origin');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // remove image
        $this->dropColumn('companhia_aerea', 'image');

        // revert names
        $this->renameColumn('companhia_aerea', 'name', 'nome');
        $this->renameColumn('companhia_aerea', 'iata_code', 'codigo_iata');
        $this->renameColumn('companhia_aerea', 'country_origin', 'pais_origem');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251210_144634_update_companhia_aerea_table cannot be reverted.\n";

        return false;
    }
    */
}
