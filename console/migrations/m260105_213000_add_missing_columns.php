<?php

use yii\db\Migration;

/**
 * Class m260105_213000_add_missing_columns
 */
class m260105_213000_add_missing_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('review', 'review_date', $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('incidente', 'type');
        $this->dropColumn('review', 'review_date');
    }
}
