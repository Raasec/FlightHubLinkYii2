<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';


// Agora usa-se RBAC para as permissoes
$isAdmin = Yii::$app->user->can('administrador');

?>
<div class="user-index">


    <?php if ($isAdmin): ?>
        <p><?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?></p>
    <?php endif; ?>

    <?php $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            [
                'attribute' => 'status',
                'filter' => [
                    9 => 'Inativo',
                    10 => 'Ativo',
                ],
                'value' => function($model) {
                    return $model->status == 10 ? 'Ativo' : 'Inativo';
                }
            ],

            [
                'attribute' => 'created_at',
                'value' => function($model){
                    return date('Y-m-d H:i', $model->created_at);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'visibleButtons' => [
                    'update' => function() use ($isAdmin) { return $isAdmin; },
                    'delete' => fn() => $isAdmin,
                    'view'   => fn() => true,
                ],
                'urlCreator' => function ($action, User $model) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
