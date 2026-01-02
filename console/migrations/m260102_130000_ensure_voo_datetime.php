<?php

use yii\db\Migration;

/**
 * Class m260102_130000_ensure_voo_datetime
 */
class m260102_130000_ensure_voo_datetime extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%voo}}', 'departure_date', $this->dateTime());
        $this->alterColumn('{{%voo}}', 'arrival_date', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260102_130000_ensure_voo_datetime cannot be reverted safely (data loss potential).\n";
        return false;
    }
}
