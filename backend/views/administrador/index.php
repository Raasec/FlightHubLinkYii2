<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdministradorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administradors';
$this->params['breadcrumbs'][] = $this->title;

$isAdmin = Yii::$app->user->can('administrador');

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?php if ($isAdmin): ?>
                                <p><?= Html::a('Criar Administrador', ['create'], ['class' => 'btn btn-success']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>


                    <?php $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id_admin',
                            'id_utilizador',
                            [
                                'attribute' => 'username',
                                'label' => 'Username',
                                'value' => function ($model) {
                                    return $model->user ? $model->user->username : '(n/a)';
                                }
                            ],
                            [
                                'attribute' => 'email',
                                'label' => 'Email',
                                'value' => function ($model) {
                                    return $model->user ? $model->user->email : '(n/a)';
                                }
                            ],
                            'nivel_acesso',
                            'responsavel_area',

                            [
                                'class' => 'yii\grid\ActionColumn',

                                'header' => 'Ações',
                                /* O Yii envia isto no link:    /administrador/view?id=1   
                                e estamos à espera disto no controller     /administrador/view?id_admin=1   
                                entao definiu-se um UrlCreator para cada um dos Roles: Administrador, Funcionario e Passageiro
                                */
                                'urlCreator' => function ($action, $model) {
                                    return Url::to([$action, 'id_admin' => $model->id_admin]);
                                },

                                'visibleButtons' => [
                                    'update' => function() use ($isAdmin) { return $isAdmin; },
                                    'delete' => function() use ($isAdmin) { return $isAdmin; },
                                    'view'   => function() { return true; },
                                ],

                                'template' => '{view} {update} {delete}',
                            ],
                        ],
                        'summaryOptions' => ['class' => 'summary mb-2'],
                        'pager' => [
                            'class' => 'yii\bootstrap4\LinkPager',
                        ]
                    ]); ?>


                </div>
                <!--.card-body-->
            </div>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
</div>
