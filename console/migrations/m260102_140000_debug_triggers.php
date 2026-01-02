<?php

use yii\db\Migration;

class m260102_140000_debug_triggers extends Migration
{
    public function safeUp()
    {
        $dbName = $this->db->createCommand("SELECT DATABASE()")->queryScalar();
        $rows = (new \yii\db\Query())
            ->select(['TRIGGER_NAME', 'EVENT_MANIPULATION', 'EVENT_OBJECT_TABLE', 'ACTION_STATEMENT'])
            ->from('information_schema.TRIGGERS')
            ->where(['TRIGGER_SCHEMA' => $dbName])
            ->all();

        echo "\n--- DB TRIGGERS ---\n";
        foreach ($rows as $row) {
            echo "Name: " . $row['TRIGGER_NAME'] . "\n";
            echo "Event: " . $row['EVENT_MANIPULATION'] . " ON " . $row['EVENT_OBJECT_TABLE'] . "\n";
            echo "Body: " . $row['ACTION_STATEMENT'] . "\n";
            echo "-------------------\n";
        }
        echo "-------------------\n";
    }

    public function safeDown()
    {
        echo "Debug migration reverted.\n";
    }
}
