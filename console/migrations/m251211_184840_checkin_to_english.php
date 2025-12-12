<?php

use yii\db\Migration;

class m251211_184840_checkin_to_english extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('checkin', 'data_checkin', 'checkin_datetime');
        $this->renameColumn('checkin', 'metodo', 'method');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('checkin', 'checkin_datetime', 'data_checkin');
        $this->renameColumn('checkin', 'method', 'metodo');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251211_184840_checkin_to_english cannot be reverted.\n";

        return false;
    }
    */
}
