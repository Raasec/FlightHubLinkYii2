<?php

namespace backend\assets;

use yii\web\AssetBundle;

class UserProfileAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/user-profile.css',
    ];

    public $js = [
        'js/user-profile.js',
    ];

    public $depends = [
        'backend\assets\AppAsset',
    ];
}
?>
