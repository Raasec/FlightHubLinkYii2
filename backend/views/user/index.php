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
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'nome',
            'email:email',

            [
                'attribute' => 'tipo_utilizador',
                'filter' => [
                    'passageiro' => 'Passageiro',
                    'funcionario' => 'Funcionário',
                    'administrador' => 'Administrador',
                ],
                'value' => function($model) {
                    return ucfirst($model->tipo_utilizador);
                }
            ],

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
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
