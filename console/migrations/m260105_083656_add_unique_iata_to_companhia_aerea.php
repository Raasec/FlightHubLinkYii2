<?php

use yii\db\Migration;

class m260105_083656_add_unique_iata_to_companhia_aerea extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
        'idx-companhia_aerea-iata_code-unique',
        'companhia_aerea',
        'iata_code',
        true
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-companhia_aerea-iata_code-unique',
            'companhia_aerea'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260105_083656_add_unique_iata_to_companhia_aerea cannot be reverted.\n";

        return false;
    }
    */
}
