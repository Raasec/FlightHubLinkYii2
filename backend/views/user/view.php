<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = "User #  {$model->id}";

$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Agora usa-se RBAC para as permissoes
$isAdmin = Yii::$app->user->can('administrador');

\yii\web\YiiAsset::register($this);

?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if ($isAdmin): ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Confirm delete?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
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
            [
                'attribute' => 'updated_at',
                'value' => function($model) {
                    return date('Y-m-d H:i', $model->updated_at);
                }
            ],


            // Se for preciso de ver estes campos depois para qualquer debugging, pode-se descomentar temporiaramente

            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'verification_token',
        ],
    ]) ?>

    <hr>

    <div class="mt-3">
        <?= Html::a(
            '← Back to Users',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>
</div>
