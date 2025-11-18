<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = 'User #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'nome',
            'email:email',

            [
                'attribute' => 'tipo_utilizador',
                'value' => function($model) {
                    return ucfirst($model->tipo_utilizador);
                }
            ],

            [
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->status == 10 ? 'Ativo' : 'Inativo';
                }
            ],

            [
                'attribute' => 'created_at',
                'value' => function($model) {
                    return date('Y-m-d H:i', $model->created_at);
                }
            ],

            'data_registo',
            [
                'attribute' => 'updated_at',
                'value' => function($model) {
                    return date('Y-m-d H:i', $model->updated_at);
                }
            ],


            // Se for preciso de ver estes campos para debugging, podes-se descomentar temporiaramente

            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'verification_token',
        ],
    ]) ?>

</div>
