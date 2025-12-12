<?php

use yii\db\Migration;

class m251211_185527_update_review_to_english extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('review', 'comentario', 'comment');
        $this->renameColumn('review', 'data_review', 'review_date');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('review', 'comment', 'comentario');
        $this->renameColumn('review', 'review_date', 'data_review');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251211_185527_update_review_to_english cannot be reverted.\n";

        return false;
    }
    */
}
