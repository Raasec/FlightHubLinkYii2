<?php

use yii\helpers\Html;
use backend\assets\UserProfileAsset;

UserProfileAsset::register($this);


/** @var yii\web\View $this */
/** @var common\models\UserProfile $model */

$this->title = 'Edit Profile: ' . ($model->user->username ?? 'User');
$this->params['breadcrumbs'] = [];
?>

<div class="user-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
