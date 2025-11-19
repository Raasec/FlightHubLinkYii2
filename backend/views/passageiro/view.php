<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Passageiro */

$this->title = "Passageiro #{$model->id_passageiro}";

$this->params['breadcrumbs'][] = ['label' => 'Passageiros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$isAdmin = Yii::$app->user->can('administrador');
$isFuncionario = Yii::$app->user->can('funcionario');


?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?php if ($isAdmin || $isFuncionario): ?>
                        <p>
                            <?= Html::a('Update', ['update', 'id_passageiro' => $model->id_passageiro], ['class' => 'btn btn-primary']) ?>

                            <?php if ($isAdmin): ?>
                                <?= Html::a('Delete', ['delete', 'id_passageiro' => $model->id_passageiro], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this Passageiro',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            <?php endif; ?>
                        </p>
                    <?php endif; ?>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id_utilizador',
                            'id_passageiro',
                            [
                                'label' => 'Username',
                                'value' => $model->user->username
                            ],
                            [
                                'label' => 'Email',
                                'value' => $model->user->email
                            ],
                            'nif',
                            'telefone',
                            'nacionalidade',
                            'data_nascimento',
                            'preferencias:ntext',
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
</div>