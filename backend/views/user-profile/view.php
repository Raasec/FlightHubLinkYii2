<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\assets\UserProfileAsset;

UserProfileAsset::register($this);


/** @var yii\web\View $this */
/** @var common\models\UserProfile $model */

$this->title = $model->user->username ?? 'User Profile';
$this->params['breadcrumbs'] = []; 

\yii\web\YiiAsset::register($this);
?>
<div class="user-profile-view">

    <!-- HEADER -->
    <div class="profile-header">
        <div class="profile-avatar">
            <img src="<?= $model->imageUrl ?>" alt="Profile image">
        </div>

        <div class="profile-main-info">
            <h1><?= Html::encode($model->full_name ?: $this->title) ?></h1>

            <span class="role-badge role-<?= $model->role_type ?>">
                <?= ucfirst($model->role_type) ?>
            </span>
        </div>
    </div>

    <!-- DETAILS -->
    <div class="profile-details">

        <div class="detail-item full-width">
            <span>Email</span>
            <strong>
                <?= $model->user
                    ? Html::encode($model->user->email)
                    : Html::tag('span', '(not set)', ['class' => 'text-muted']) ?>
            </strong>
        </div>

        <div class="detail-item">
            <span>Gender</span>
            <strong>
                <?= $model->gender
                    ? ucfirst(Html::encode($model->gender))
                    : Html::tag('span', '(not set)', ['class' => 'text-muted']) ?>
            </strong>
        </div>


        <div class="detail-item">
            <span>Date of Birth</span>
            <strong><?= Yii::$app->formatter->asDate($model->date_of_birth) ?></strong>
        </div>


        <div class="detail-item">
            <span>Phone</span>
            <strong><?= Html::encode($model->phone) ?></strong>
        </div>

        <div class="detail-item">
            <span>NIF</span>
            <strong><?= Html::encode($model->nif) ?></strong>
        </div>

        <div class="detail-item">
            <span>Nationality</span>
            <strong><?= Html::encode($model->nationality) ?></strong>
        </div>

        <div class="detail-item">
            <span>Country</span>
            <strong><?= Html::encode($model->country) ?></strong>
        </div>

        <div class="detail-item full-width">
            <span>Address</span>
            <strong><?= Html::encode($model->address) ?></strong>
        </div>

        <div class="detail-item">
            <span>Postal Code</span>
            <strong><?= Html::encode($model->postal_code) ?></strong>
        </div>

    </div>

    <!-- ACTIONS -->
    <div class="mt-3">
        <?= Html::a(
            'Update Profile',
            ['update', 'id' => $model->id],
            ['class' => 'btn btn-primary']
        ) ?>
    </div>

    <div class="mt-3">
        <?= Html::a(
            '← Back to User Profiles',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>

</div>
