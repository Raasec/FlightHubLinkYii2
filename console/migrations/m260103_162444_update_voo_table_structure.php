<?php

use yii\db\Migration;

class m260103_162444_update_voo_table_structure extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // deviamos ter feito isto mais cedo mas status deve ser so 1 ou 0 n sei porque esta varchar
        $this->execute("UPDATE voo SET status = '1' WHERE status NOT IN ('0', '1') OR status IS NULL");
        
        // status para tinyint 
        $this->alterColumn('voo', 'status', $this->smallInteger(1)->notNull()->defaultValue(1));

        // ou meter um default A se estiver vazio
        $this->execute("UPDATE voo SET gate = 'A' WHERE gate IS NULL OR gate = ''");
        $this->execute("UPDATE voo SET gate = LEFT(gate, 1)");
        
        // alteramos gate para char(1)
        $this->alterColumn('voo', 'gate', $this->char(1)->notNull()->defaultValue('A'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('voo', 'status', $this->string(50));
        $this->alterColumn('voo', 'gate', $this->string(50));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260103_162444_update_voo_table_structure cannot be reverted.\n";

        return false;
    }
    */
}
