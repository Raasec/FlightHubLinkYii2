<?php

namespace console\rbac;

use yii\rbac\Rule;
use common\models\UserProfile;

class ViewOwnUserProfileRule extends Rule
{
    public $name = 'isOwnUserProfile';

    public function execute($user, $item, $params)
    {
        if (!isset($params['model'])) {
            return false;
        }

        /** @var UserProfile $profile */
        $profile = $params['model'];

        return $profile->user_id == $user;
    }
}

?>