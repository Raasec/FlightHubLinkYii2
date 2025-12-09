<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_profile}}`.
 */
class m251209_043117_create_user_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 1. Create table with InnoDB (MyISAM was breaking columns)
        $this->createTable('user_profile', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'image' => $this->string(),
            'full_name' => $this->string(),
            'gender' => $this->string(20),
            'date_of_birth' => $this->date(),
            'phone' => $this->string(20),
            'nif' => $this->string(15),
            'nationality' => $this->string(50),
            'country' => $this->string(50),
            'address' => $this->string(255),
            'postal_code' => $this->string(15),
            'role_type' => $this->string(20),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

        // 2. Convert columns into ENUM after creation
        $this->execute("
            ALTER TABLE user_profile 
            MODIFY gender ENUM('male','female','other') NULL;
        ");

        $this->execute("
            ALTER TABLE user_profile 
            MODIFY role_type ENUM('administrador','funcionario','passageiro') NOT NULL;
        ");

        // 3. Add foreign key
        $this->addForeignKey(
            'fk_user_profile_user',
            'user_profile',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user_profile_user', 'user_profile');
        $this->dropTable('user_profile');
    }
}
