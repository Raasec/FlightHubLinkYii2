<?php

namespace backend\modules\api\models;

use yii\db\ActiveRecord;

class Voo extends ActiveRecord
{
    public static function tableName()
    {
        return 'voo';
    }
}

?>