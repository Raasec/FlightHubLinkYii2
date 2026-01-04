<?php

use yii\db\Migration;

/**
 * Adds response column to pedido_assistencia table.
 */
class m260102_150000_add_response_to_pedido_assistencia extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            '{{%pedido_assistencia}}',
            'response',
            $this->text()->null()->after('description')
        );
    }

    public function safeDown()
    {
        $this->dropColumn('{{%pedido_assistencia}}', 'response');
    }
}
