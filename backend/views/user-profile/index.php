<?php

use common\models\UserProfile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\UserProfileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'User Profiles';
$this->params['breadcrumbs'] = [];
?>
<div class="user-profile-index">

    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-hover'],
        'columns' => [

            //ID
            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:70px'],
            ],

            //Avatar / image
            [
                'label' => 'Avatar',
                'format' => 'raw',
                'value' => function (UserProfile $model) {
                    return Html::img(
                    $model->imageUrl,
                    [
                            'style' => 'width:40px;height:40px;border-radius:50%;object-fit:cover;',
                            'alt'   => 'Avatar',
                        ]
                    );
                },
                'filter' => false,
                'headerOptions' => ['style' => 'width:80px'],
            ],

            // Username ()
            [
                'label' => 'Username',
                'attribute' => 'username',
                'value' => fn(UserProfile $model) => $model->user->username ?? '-',
            ],

            // FUll name
            'full_name',

            //Gender
            [
                'attribute' => 'gender',
                'value' => fn(UserProfile $model) => $model->gender ? ucfirst($model->gender) : '-',
                'filter' => [
                    'male' => 'Male',
                    'female' => 'Female',
                    'other' => 'Other',
                ],
            ],

            //Role
            [
                'attribute' => 'role_type',
                'value' => fn(UserProfile $model) => ucfirst($model->role_type),
                'filter' => [
                    'administrador' => 'Administrador',
                    'funcionario'   => 'Funcionario',
                    'passageiro'    => 'Passageiro',
                ],
            ],

            //'date_of_birth',
            //'phone',
            //'nif',
            //'nationality',
            //'country',
            //'address',
            //'postal_code',
            //'role_type',

            // Actions
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update}',
                'urlCreator' => function ($action, UserProfile $model) {
                    return Url::to([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
