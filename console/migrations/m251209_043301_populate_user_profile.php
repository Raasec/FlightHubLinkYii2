<?php

use yii\db\Migration;

class m251209_043301_populate_user_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Fetch all users
        $users = (new \yii\db\Query())
            ->from('user')
            ->all();

        foreach ($users as $user) 
        {
            
            // Determine role based on existing related tables
            $role = null;

            // Is admin?
            $admin = (new \yii\db\Query())
                ->from('administrador')
                ->where(['id_utilizador' => $user['id']])
                ->one();

            if ($admin) {
                $role = 'administrador';
            }

            // Is funcionario?
            $func = (new \yii\db\Query())
                ->from('funcionario')
                ->where(['id_utilizador' => $user['id']])
                ->one();

            if ($func) {
                $role = 'funcionario';
            }

            // Is passageiro?
            $pass = (new \yii\db\Query())
                ->from('passageiro')
                ->where(['id_utilizador' => $user['id']])
                ->one();

            if ($pass) {
                $role = 'passageiro';
            }

            // If user has none of these roles, default to passageiro or NULL
            if ($role === null) {
                $role = 'passageiro'; // or set to null if you want
            }

            // Insert into user_profile
            $this->insert('user_profile', [
                'user_id' => $user['id'],
                'image' => null,
                'full_name' => null,
                'gender' => null,
                'date_of_birth' => null,
                'phone' => null,
                'nif' => null,
                'nationality' => null,
                'country' => null,
                'address' => null,
                'postal_code' => null,
                'role_type' => $role,
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user_profile');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251209_043301_populate_user_profile cannot be reverted.\n";

        return false;
    }
    */
}
