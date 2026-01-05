<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Funcionario */
/** @var \common\models\User $user */

$this->title = "Employee #".$model->id_funcionario;



\yii\web\YiiAsset::register($this);



$user = $user ?? Yii::$app->user->identity;

// Agora usamos RBAC em vez de tipo-utilizador para se fazer a identifacao do utilizador
$isAdmin = Yii::$app->user->can('administrador');

// + Owner para deixar o proprio funcionario visualizar
$isOwner = $model->id_utilizador == $user->id;

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?php if ($isAdmin || $isOwner): ?>
                        <?= Html::a('Update', ['update', 'id_funcionario' => $model->id_funcionario], ['class' => 'btn btn-primary']) ?>
                        <?php endif; ?>

                        <?php if ($isAdmin): ?>
                        <?= Html::a('Delete', ['delete', 'id_funcionario' => $model->id_funcionario], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                        <?php endif; ?>
                    </p>
                    
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id_utilizador',
                            'id_funcionario',
                            [
                                'label' => 'Username',
                                'value' => $model->user->username
                            ],
                            [
                                'label' => 'Email',
                                'value' => $model->user->email
                            ],
                            'department',
                            'job_position',
                            [
                                'attribute' => 'shift',
                                'value' => $model->getShiftLabel(),
                            ],
                            'hire_date',
                        ],
                    ]) ?>
                </div>
                <!--.col-md-12-->
            </div>
            <!--.row-->
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->

    <hr>

    <div class="mt-3">
        <?= Html::a(
            '← Back to Employees',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>
</div>