<?php

use yii\db\Migration;

class m251211_184727_update_bilhete_to_english extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('bilhete', 'porta_embarque', 'gate');
        $this->renameColumn('bilhete', 'data_emissao', 'issue_date');
        $this->renameColumn('bilhete', 'preco', 'price');

        // Avoid reserved word "class" in PHP, so use travel_class
        $this->renameColumn('bilhete', 'classe', 'travel_class');

        $this->renameColumn('bilhete', 'assento', 'seat');
        $this->renameColumn('bilhete', 'estado', 'status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('bilhete', 'gate', 'porta_embarque');
        $this->renameColumn('bilhete', 'issue_date', 'data_emissao');
        $this->renameColumn('bilhete', 'price', 'preco');
        $this->renameColumn('bilhete', 'travel_class', 'classe');
        $this->renameColumn('bilhete', 'seat', 'assento');
        $this->renameColumn('bilhete', 'status', 'estado');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251211_184727_update_bilhete_to_english cannot be reverted.\n";

        return false;
    }
    */
}
