<?php

use yii\db\Migration;

class m260105_150000_allow_null_fk_incidente extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('incidente', 'id_notificacao', $this->integer()->null());

        $this->alterColumn('notificacao', 'id_voo', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('incidente', 'id_notificacao', $this->integer()->notNull());
        $this->alterColumn('notificacao', 'id_voo', $this->integer()->notNull());
    }
}
