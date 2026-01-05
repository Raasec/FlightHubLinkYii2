<?php

use yii\db\Migration;

class m260105_190000_add_read_at_to_passageiro extends Migration
{
    public function safeUp()
    {
        $this->addColumn('passageiro', 'last_notification_read_at', $this->dateTime()->null());
    }

    public function safeDown()
    {
        $this->dropColumn('passageiro', 'last_notification_read_at');
    }
}
